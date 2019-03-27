<template>
  <template>
    <div style="text-align:center">
      <div class="msgbox">
	<span></span>
	<script>
	  var title=thisNode.getNextChild({"name":"signuptt"}).getRelationship({name:"domelementsdata"}).getChild();
	  title.writeProperty(thisElement);
	  //adding the edition pencil
	  var launcher = new Node();
	  launcher.thisNode = title;
	  launcher.editElement = thisElement;
	  launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
	</script>
      </div>
    </div>
    <div>
      <form>
	<table class="formtable" style="box-shadow: 0px 3px 6px rgb(136, 136, 136);">
	  <tr>
	    <td style="padding-top:1em;">
	      <div class="form-group">
		<div style="display:table;">
		  <span class="form-label"></span>
		  <script>
		    var myNode=thisNode.getNextChild({name:"userName"}).getRelationship("domelementsdata").getChild();
		    myNode.writeProperty(thisElement);
		    var launcher = new Node();
		    launcher.thisNode = myNode;
		    launcher.editElement = thisElement;
		    launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
		  </script>
		</div>
		<input class="form-control" placeholder="" name="user_name">
		<script>
		  var myNode=thisNode.getNextChild({name:"userName"}).getRelationship("domelementsdata").getChild();
		  myNode.writeProperty(thisElement, null, "placeholder");
		  var launcher = new Node();
		  launcher.thisNode = myNode;
		  launcher.editElement = thisElement;
		  launcher.thisAttribute = "placeholder";
		  launcher.createInput=true;
		  launcher.visibility="visible";
		  launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
		</script>
	      </div>
	    </td>
	  </tr>
	  <tr>
	    <td>
	      <div class="form-group">
		<div style="display:table;">
		  <span class="form-label"></span>
		  <script>
		    var myNode=thisNode.getNextChild({name:"password"}).getRelationship("domelementsdata").getChild();
		    myNode.writeProperty(thisElement);
		    var launcher = new Node();
		    launcher.thisNode = myNode;
		    launcher.editElement = thisElement;
		    launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
		  </script>
		</div>
		<input type="password" class="form-control" placeholder="" name="user_password">
		<script>
		  var myNode=thisNode.getNextChild({name:"password"}).getRelationship("domelementsdata").getChild();
		  myNode.writeProperty(thisElement, null, "placeholder");
		  var launcher = new Node();
		  launcher.thisNode = myNode;
		  launcher.editElement = thisElement;
		  launcher.thisAttribute = "placeholder";
		  launcher.createInput=true;
		  launcher.visibility="visible";
		  launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
		</script>
	      </div>
	    </td>
	  </tr>
	  <tr>
	    <td style="text-align:center">
	      <div style="padding-bottom: 1rem; display:table; margin: auto;">
		<input type="submit" class="btn" value="" style="font-size:medium;">
		<script>
		  var myNode=thisNode.getNextChild({name:"login"}).getRelationship("domelementsdata").getChild();
		  myNode.writeProperty(thisElement, null, "value");
		  var launcher = new Node();
		  launcher.thisNode = myNode;
		  launcher.editElement = thisElement;
		  launcher.thisAttribute = "value";
		  launcher.createInput=true;
		  launcher.visibility="visible";
		  launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
		</script>
	      </div>
	    </td>
	  </tr>
	</table>
	<div style="display:table;">
	  <input type="hidden" name="userCharError">
	  <script>
	    var myNode=thisNode.getNextChild({name:"userCharError"}).getRelationship("domelementsdata").getChild();
	    myNode.writeProperty(thisElement, null, "value");
	    var launcher = new Node();
	    launcher.thisNode = myNode;
	    launcher.editElement = thisElement;
	    launcher.thisAttribute = "value";
	    launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
	    if (webuser.isWebAdmin()) thisElement.type="input";
	  </script>
	</div>
	<div style="display:table;">
	  <input type="hidden" name="pwdCharError">
	  <script>
	    var myNode=thisNode.getNextChild({name:"pwdCharError"}).getRelationship("domelementsdata").getChild();
	    myNode.writeProperty(thisElement, null, "value");
	    var launcher = new Node();
	    launcher.thisNode = myNode;
	    launcher.editElement = thisElement;
	    launcher.thisAttribute = "value";
	    launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
	    if (webuser.isWebAdmin()) thisElement.type="input";
	  </script>
	</div>
	<div style="display:table;">
	  <input type="hidden" name="signedIn">
	  <script>
	    var myNode=thisNode.getNextChild({name:"signedIn"}).getRelationship("domelementsdata").getChild();
	    myNode.writeProperty(thisElement, null, "value");
	    var launcher = new Node();
	    launcher.thisNode = myNode;
	    launcher.editElement = thisElement;
	    launcher.thisAttribute = "value";
	    launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
	    if (webuser.isWebAdmin()) thisElement.type="input";
	  </script>
	</div>
	<div style="display:table;">
	  <input type="hidden" name="userExistsError">
	  <script>
	    var myNode=thisNode.getNextChild({name:"userExistsError"}).getRelationship("domelementsdata").getChild();
	    myNode.writeProperty(thisElement, null, "value");
	    var launcher = new Node();
	    launcher.thisNode = myNode;
	    launcher.editElement = thisElement;
	    launcher.thisAttribute = "value";
	    launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
	    if (webuser.isWebAdmin()) thisElement.type="input";
	  </script>
	</div>
      </form>
      <script>
	thisElement.addEventListener("submit", function(e) {
	  e.preventDefault();
	  var min=4, max=15;
	  if (!DomMethods.checklength(thisElement.elements.user_name.value, min, max)) {
	    alert(eval(this.elements.userCharError.value));
	    return false;
	  }
	  if (!DomMethods.checklength(thisElement.elements.user_password.value, min, max)) {
	    alert(eval(this.elements.pwdCharError.value));
	    return false;
	  }
	  webuser.create(thisElement.elements.user_name.value, thisElement.elements.user_password.value, null, function(){
	    if (this.extra && this.extra.error) {
	      myalert.properties.alertmsg=thisElement.elements[this.extra.errorName].value;
	      myalert.properties.timeout=3000;
	      myalert.showalert();
	      return false;
	    }
	    myalert.properties.alertmsg=thisElement.elements.signedIn.value;
	    myalert.properties.timeout=3000;
	    myalert.showalert();
	  });
	  return false;
	});
      </script>
      <div style="margin:auto;  display:table;">
	<button class="btn"></button>
	<script>
	  var myNode=thisNode.getNextChild({name:"loginBack"}).getRelationship("domelementsdata").getChild();
	  myNode.writeProperty(thisElement);
	  thisElement.onclick=function(){
	    (new NodeMale()).refreshView(document.getElementById("centralcontent"), "templates/loginform.php");
	  }
	  var launcher = new Node();
	  launcher.thisNode = myNode;
	  launcher.createInput=true;
	  launcher.visibility="visible";
	  launcher.editElement = thisElement;
	  launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
	</script>
      </div>
    </div>
  </template>
  <div></div>
  <script>
    var logform=domelementsrootmother.getChild().getNextChild({name:"labels"}).getNextChild({name:"middle"}).getNextChild({name:"logform"});
    logform.refreshView(thisElement,thisElement.previousElementSibling);
  </script>
</template>