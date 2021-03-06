<?php
include('includes/config.php');
include('includes/default.php');
if (defined('DB_PREFIX')) { $tablePrefix=DB_PREFIX;}
?>
<!DOCTYPE html>
  <head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="javascript/default.js"></script>
    <script src="javascript/config.js"></script>
    <script src="javascript/iesp.js"></script>
    <script src="javascript/nodes.js"></script>
    <script src="javascript/nodesconfig.js"></script>
    <script src="javascript/dommethods.js"></script>
    <script src="javascript/cart.js"></script>
    <script src="javascript/user.js"></script>
    <script async src="javascript/stats.js.php"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
<?php if (defined('THEME')) { ?>
    <link rel="stylesheet" type="text/css" href="css/themes/<?php echo THEME; ?>/main.css">
<?PHP } ?>    
    <link rel="icon" href="favicon.ico">
  </head>
  <body>
    <script>
      var textEditorSaved=''; //This var saves the textEditor data to not be deteleted each time
      //history facility
      window.onpopstate = function(event) {
        if (!event.state) return;
        var link=document.querySelector("a[href='" + event.state.url + "']");
        if (link) link.click();
      };
      function loadTemplates() {
        //We load all the templates at once
        return new Promise((resolve, reject) => {
          var tpLoader=new Node();
          tpLoader.appendThis(document.body, "templates.php").then(resolve);
        });
      }
      function loadLabels() {
        return new Promise((resolve, reject) => {
          var myLanguage=webuser.extra.language.properties.id;
          domelementsrootmother.getChild().getNextChild({name: "labels"}).loadfromhttp({action:"load my tree", language: myLanguage}).then(function(myNode){
            if (!Config.onEmptyValueText) Config.onEmptyValueText=myNode.getNextChild({name: "not located"}).getNextChild({name: "emptyvallabel"}).getRelationship({name: "domelementsdata"}).getChild().properties.value;
            resolve();
          });
        });
      }
      var webuser=new user();
      //we load the alert template and create alert object
      var myalert=new Alert();
      myalert.properties.alertclass="alertmsg";

      //We load the dom elements text that will be included in some parts of the document
      var domelementsroot=null;
      var languages=null;
      domelementsrootmother=new NodeFemale();
      //We show a message if the php version is not compatible
      (new Node()).loadfromhttp({action:"check php version"}).then(function(myNode){
        if (myNode.extra && myNode.extra.error) {
          myalert.properties.alertmsg='PHP version is lower than required, plese update PHP';
          myalert.showalert().then(function(){throw 'PHP version error';});
        }
      });
      //First of all we check that the database connection is ok
      domelementsrootmother.loadfromhttp({action:"check db link"}).then(function(myNode){
        if (myNode.extra && myNode.extra.error) {
          myalert.properties.alertmsg='<p><b>Database Connection Failed</b></p><p>Please check includes/config.php file.</p>';
          myalert.showalert().then(function(){throw 'Database Connection Failed';});
        }
        else {
          var mytables=new NodeFemale();
          mytables.loadfromhttp({action:"load tables"<?php if ($tablePrefix) echo ', prefix:"' . $tablePrefix . '"'; ?>}).then(function(myNode){
            if (mytables.children.length==0) {
              myalert.properties.alertmsg='No Database Tables.';
              myalert.showalert().then(function(){throw 'No Database Tables';});
            }
          });
        }
        domelementsrootmother.properties.childtablename="TABLE_DOMELEMENTS";
        domelementsrootmother.properties.parenttablename="TABLE_DOMELEMENTS";
        domelementsrootmother.loadfromhttp({action:"load root"}).then(function(myNode){
          //if no root means that table domelements doesn't exist or has no elements
          if (myNode.children.length==0) {
            myalert.properties.alertmsg='<p><b>Database Content Error</b></p><p>Please import includes/database.sql file.</p>';
            myalert.showalert().then(function(){throw 'Database Content Failed';});
          }
          domelementsroot=myNode.getChild();
          domelementsroot.loadfromhttp({action:"load my tree", deepLevel: 2}).then(function(myNode){
            webuser.loadfromhttp({action: "load session", sesname: "user"}).then(function(){
              if (!webuser.extra) webuser.extra={};
              if (!webuser.extra.language) {
                var languagesmother=new NodeFemale();
                languagesmother.properties.childtablename="TABLE_LANGUAGES";
                languagesmother.properties.parenttablename="TABLE_LANGUAGES";
                languagesmother.loadfromhttp({action:"load root"}).then(function(myNode){
                  var langsroot=myNode.getChild();
                  langsroot.loadfromhttp({action:"load my relationships"}).then(function(myNode){
                    var langrelkey=0;
                    for (var i=0; i<langsroot.relationships.length; i++) {
                      if (myNode.relationships[i].properties.childtablename=="TABLE_LANGUAGES") {
                          langrelkey=i;
                          break;
                      }
                    }
                    languages=langsroot.relationships[langrelkey];
                    languages.loadfromhttp({action:"load my children"}).then(function(myNode){
                      var webLanguages=[];
                      languages.children.forEach(function (child){
                        webLanguages.push(child.properties.code);
                      });
                      for (var i=0; i<window.navigator.languages.length; i++) {
                        window.navigator.languages[i]=window.navigator.languages[i].replace(/-.+/, "");
                        if (webLanguages.indexOf(window.navigator.languages[i]) >= 0) {
                          webuser.extra.language=myNode.getChild({code: window.navigator.languages[i]});
                          break;
                        }
                      }
                      if (!webuser.extra.language) webuser.extra.language=myNode.getChild();
                      loadLabels().then(function(){
                        if (Config.loadTemplatesAtOnce!==false) {
                          loadTemplates().then(function(){
                            domelementsrootmother.dispatchEvent("loadLabels");
                          });
                        }
                        else {
                          domelementsrootmother.dispatchEvent("loadLabels");
                        }
                      });
                    });
                  });
                });
              }
              else {
                loadLabels().then(function(){
                  if (supportsTemplate() && Config.loadTemplatesAtOnce!==false) {
                    loadTemplates().then(function(){
                      domelementsrootmother.dispatchEvent("loadLabels");
                    });
                  }
                  else {
                    domelementsrootmother.dispatchEvent("loadLabels");
                  }
                });
              }
            });
          });
        });
      });
    </script>
    <div class="backgroundimage">
      <div class="backgroundspace">
        <img id="initloader" src="css/images/loader-1.gif" style="position: absolute; top: 30%; left: 50%; transform: translateX(-50%); z-index:100;">
        <div class="mainblock">
          <?php include('includes/documentparts/top.php'); ?>
          <nav class="categories">
            <?php include("includes/documentparts/left.php"); ?>
          </nav>
          <main>
            <?php include("includes/documentparts/center.php"); ?>
          </main>
          <footer>
            <?php include("includes/documentparts/bottom.php"); ?>
          </footer>
        </div>
      </div>
    </div>
  </body>
</html>
