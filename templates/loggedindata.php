<template>
  <template>
    <div style="padding-bottom: 1em; text-align:center">
      <div class="msgbox">
        <span></span>
	<script>
	  var title=domelementsrootmother.getChild().getNextChild({name:"labels"}).getNextChild({name:"middle"}).getNextChild({name:"loggedin"}).getNextChild({name:"dashboardtit"}).getRelationship("domelementsdata").getChild();
	  title.writeProperty(thisElement);
	  //adding the edition pencil
	  var launcher = new Node();
	  launcher.thisNode = title;
	  launcher.editElement = thisElement;
	  launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
	</script>
        <span></span>
        <script>
          webuser.writeProperty(thisElement, "username");
        </script>
      </div>
    </div>
    <div style="display:grid; grid-template-columns: auto auto; width:40em;" class="formtable"></div>
    <script>
      var getuserdata=new Promise((resolve, reject) => {
        var datarel=webuser.getRelationship("usersdata");
        if (datarel.children.length==0) {
          datarel.loadfromhttp({action: "load my children", user_id: webuser.properties.id}).then((myNode) => {
            resolve(myNode.getChild());
          });
        }
        else resolve(datarel.getChild());
      });
      getuserdata.then((myNode) => {
	myNode.editable=true;
	myNode.refreshPropertiesView(thisElement,"templates/singlefield.php");
      });
      
    </script>
    <div style="margin:auto; display:table; margin-bottom: 1em;">
      <button class="btn"></button>
      <script>
	var btShowOrd=domelementsrootmother.getChild().getNextChild({name:"labels"}).getNextChild({name:"middle"}).getNextChild({name:"loggedin"}).getNextChild({name:"btShowOrd"});
	btShowOrd.getRelationship("domelementsdata").getChild().writeProperty(thisElement);
	//adding the edition pencil
	var launcher = new Node();
	launcher.thisNode = btShowOrd.getRelationship("domelementsdata").getChild();
	launcher.editElement = thisElement;
	launcher.createInput=true;
	launcher.visibility="visible";
	launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
	thisElement.onclick=function(){
	  (new Node()).refreshView(document.getElementById("centralcontent"), "templates/showorders.php");
	}
      </script>
    </div>
    <div style="margin:auto; display:table; margin-bottom: 1em;">
      <button class="btn"></button>
      <script>
	var btShowAdd=domelementsrootmother.getChild().getNextChild({name:"labels"}).getNextChild({name:"middle"}).getNextChild({name:"loggedin"}).getNextChild({name:"btShowAdd"});
	btShowAdd.getRelationship("domelementsdata").getChild().writeProperty(thisElement);
	//adding the edition pencil
	var launcher = new Node();
	launcher.thisNode = btShowAdd.getRelationship("domelementsdata").getChild();
	launcher.editElement = thisElement;
	launcher.createInput=true;
	launcher.visibility="visible";
	launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
	thisElement.onclick=function(){
	  (new Node()).refreshView(document.getElementById("centralcontent"), "templates/showaddress.php");
	}
      </script>
    </div>
    <div style="margin:auto; display:table; margin-bottom: 1em;">
      <button class="btn"></button>
      <script>
	var btChangePwd=domelementsrootmother.getChild().getNextChild({name:"labels"}).getNextChild({name:"middle"}).getNextChild({name:"loggedin"}).getNextChild({name:"btChangePwd"});
	btChangePwd.getRelationship("domelementsdata").getChild().writeProperty(thisElement);
	//adding the edition pencil
	var launcher = new Node();
	launcher.thisNode = btChangePwd.getRelationship("domelementsdata").getChild();
	launcher.editElement = thisElement;
	launcher.createInput=true;
	launcher.visibility="visible";
	launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
	thisElement.onclick=function(){
	  (new Node()).refreshView(document.getElementById("centralcontent"), "templates/changepwd.php");
	}
      </script>
    </div>
    <div style="margin:auto; display:table;">
      <button class="btn"></button>
      <script>
	var logOut=domelementsrootmother.getChild().getNextChild({name:"labels"}).getNextChild({name:"middle"}).getNextChild({name:"loggedin"}).getNextChild({name:"btLogOut"});
	logOut.getRelationship("domelementsdata").getChild().writeProperty(thisElement);
	//adding the edition pencil
	var launcher = new Node();
	launcher.thisNode = logOut.getRelationship("domelementsdata").getChild();
	launcher.editElement = thisElement;
	launcher.createInput=true;
	launcher.visibility="visible";
	launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
	thisElement.onclick=function(){
            if (webuser.properties.id) {
              webuser.logoff();
            }
            (new Node()).refreshView(document.getElementById("centralcontent"), "templates/loginform.php");
	}
      </script>
    </div>
  </template>
  <div style="text-align:center"></div>
  <script>
    //if cart it is not empty -> redirect to checkout
    if (mycart.getRelationship("cartitem").children.length>0) {
      (new Node()).refreshView(document.getElementById("centralcontent"), 'templates/checkout1.php');
    }
    else {
      (new Node()).refreshView(document.getElementById("centralcontent"), thisElement.parentElement.querySelector("template")).then(function(){
	var url='?userarea=1';
	if (history.state && history.state.url==url) {
	  return;
	}
	history.pushState({url:url}, null, url);
      });
    }
  </script>
</template>