<template>
  <tr>
    <td style=" padding-right:1em;">
      <input type="radio" name="shipping">
      <script>
        thisElement.addEventListener("change", function(event) {
          var shippingtypesRel=webuser.getRelationship({name:"orders"}).getChild().getRelationship({name:"ordershippingtypes"});
          shippingtypesRel.children=[]; //In case we already selected
          var orderShippingType=shippingtypesRel.addChild(new NodeMale());
          orderShippingType.properties.cloneFromArray(thisNode.getRelationship({name:"shippingtypesdata"}).getChild().properties);
          orderShippingType.properties.cloneFromArray(thisNode.properties);
          DomMethods.setActive(thisNode);
        });
        //selecting first option
        if (thisNode.parentNode.getChild()==thisNode) {
          thisElement.click();
        }
      </script>
    </td>
    <td style="text-align:left; padding-right:2em;">
      <span>
        <a href="" data-hbutton="true" title=""></a>
        <script>
          thisNodeData=thisNode.getRelationship({name: "shippingtypesdata"}).getChild();
          thisNodeData.writeProperty(thisElement, "name");
          thisNodeData.writeProperty(thisElement, "description", "title");
          var launcher = new Node();
          launcher.thisNode = thisNodeData;
          launcher.editElement = thisElement;
          launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
          if (webuser.isWebAdmin()) {
            //We add a table cell for description to be editable
            var myRow=DomMethods.closesttagname(thisElement, "TR");
            var myCell = myRow.insertCell(2);
            var myDiv = document.createElement('div');
            myDiv.style.marginRight="2.2em";
            var mySpan=document.createElement('span');
            myDiv.appendChild(mySpan);
            myCell.appendChild(myDiv);
            thisNodeData.writeProperty(mySpan, "description");
            var description_launcher = new Node();
            description_launcher.thisNode = thisNodeData;
            description_launcher.thisProperty = "description";
            description_launcher.editElement = mySpan;
            description_launcher.appendThis(myDiv, "templates/addbutedit.php");
          }

          thisElement.addEventListener("click", function(event) {
            event.preventDefault();
            myalert.properties.alertmsg=thisNodeData.properties.description;
            myalert.showalert();
          });
        </script>
      <span>
    </td>
    <td style="text-align:right; padding-right:2em;">
      <span>
        <span></span>
        <script>
          thisNode.writeProperty(thisElement, "delay_hours");
          var launcher = new Node();
          launcher.thisNode = thisNode;
          launcher.editElement = thisElement;
          launcher.thisProperty="delay_hours";
          launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
        </script>
      </span>
      <span></span>
      <script>
        var myhours=domelementsrootmother.getChild().getNextChild({name: "labels"}).getNextChild({"name":"middle"}).getNextChild({"name":"hours"}).getRelationship({name: "domelementsdata"}).getChild();
        myhours.writeProperty(thisElement);
      </script>
    </td>
    <td style="text-align:right;">
      <span>
        <span></span>
        <script>
          thisNode.writeProperty(thisElement, "price");
          var launcher = new Node();
          launcher.thisNode = thisNode;
          launcher.editElement = thisElement;
          launcher.thisProperty="price";
          launcher.appendThis(thisElement.parentElement, "templates/addbutedit.php");
        </script>
      </span>
      <span></span>
      <script>
        var currency=domelementsrootmother.getChild().getNextChild({name: "labels"}).getNextChild({"name":"middle"}).getNextChild({"name":"currency"}).getRelationship({name: "domelementsdata"}).getChild();
        currency.writeProperty(thisElement);
      </script>
    </td>
  </tr>
  <script>
      var admnlauncher=new Node();
      admnlauncher.thisNode=thisNode;
      admnlauncher.editElement = thisElement;
      admnlauncher.btposition="btmiddleright";
      admnlauncher.elementsListPos="vertical";
      admnlauncher.newNode=thisNode.parentNode.newNode.cloneNode(0, null); // we duplicate it so newNode can be reused
      admnlauncher.newNode.loadasc(thisNode, 2, "id"); //the parent is not the same
      admnlauncher.newNode.sort_order=thisNode.sort_order + 1;
      admnlauncher.appendThis(thisElement.lastElementChild, "templates/addadmnbuts.php");
      thisElement.addEventListener("click", function(event) {
        thisElement.querySelector("input").click();
      });
  </script>
</template>