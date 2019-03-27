<template>
  <span style="z-index:1">
    <a href="javascript:" data-button="true" data-hbutton="true"></a>
    <script>
      var url='?category=' + thisNode.properties.id;
      thisElement.href=url;
      thisNode.getRelationship({name: "itemcategoriesdata"}).loadfromhttp({action: "load my children", language: webuser.extra.language.properties.id}, function(){
	this.getChild().writeProperty(thisElement);
	var launcher = new Node();
	launcher.thisNode = this.getChild();
	launcher.editElement = thisElement;
	launcher.btposition="btmiddleleft";
	launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
	var admnlauncher=new Node();
	admnlauncher.thisNode=thisNode;
	admnlauncher.editElement = thisElement;
	admnlauncher.btposition="btmiddleright";
	admnlauncher.elementsListPos="vertical";
	admnlauncher.newNode=thisNode.parentNode.newNode.cloneNode(0, null); // we duplicate it so newNode can be reused
	admnlauncher.newNode.loadasc(thisNode, 2, "id"); //the parent is not the same
	admnlauncher.newNode.sort_order=thisNode.sort_order + 1;
	admnlauncher.appendThis(thisElement.parentElement, "templates/addadmnbuts.php");
      });
      thisElement.addEventListener("click", function(event) {
	event.preventDefault();
	DomMethods.setActive(thisNode);
	thisNode.getRelationship().loadfromhttp({action:"load my tree", deepLevel: 2}, function(){
	  this.newNode=thisNode.parentNode.newNode.cloneNode(0, null); // we duplicate it so newNode can be reused
	  this.newNode.parentNode=new NodeFemale(); //the parentNode is not the same
	  this.newNode.parentNode.load(this, 1, 0, null, "id");
	  this.appendThis(document.getElementById("centralcontent"), "templates/admnlisteners.php");
	  this.refreshView(document.getElementById("centralcontent"),"templates/catalog.php");
	});
	if (history.state && history.state.url==url) {
	  return;
	}
	history.pushState({url:url}, null, url);
      });
    </script>
  </span>
</template>