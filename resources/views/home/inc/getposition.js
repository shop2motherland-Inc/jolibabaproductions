function show_subcategories(id) {
  document.getElementById("showsubcategories").innerHTML = "";
  // var element=document.getElementById("maincategory");
  divElement = document.querySelector(".maincategory");
  console.log($(".maincategory").position());
  console.log($(".maincategory").offset());

  let subcat = [];
  var cat = id;
  $("#removecat").removeClass("d-none");
  $.ajax({
    url: `changeCategorySession/${cat}`,
    type: "get",
    success: function (response) {
      response.forEach((item) => {
        // Create an "li" node:
        const div = document.createElement("div");
        div.setAttribute("style", "background-color:white");
        const node = document.createElement("li");
        node.setAttribute("style", "border-bottom: #0060ff 1px solid;");
        // Create a text node:
        // const textnode = document.createTextNode(item.name);

        var span = document.createElement("a");
        span.setAttribute("href", "{{URL('category')}}" + "/" + item.slug);
        span.setAttribute(
          "style",
          "color:white;padding:10px  0px 10px 20px;display:block"
        );
        // span.className = 'toggle';
        span.appendChild(document.createTextNode(item.name));

        // Append the text node to the "li" node:
        node.appendChild(span);
        div.appendChild(node);
        // Append the "li" node to the list:
        document.getElementById("showsubcategories").appendChild(node);
      });
    },
    statusCode: {
      404: function () {
        // alert('web not found');
      },
    },
    error: function (x, xs, xt) {
      //nos dara el error si es que hay alguno
      window.open(JSON.stringify(x));
      //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
    },
  });
}

function removeCat() {
  document.getElementById("showsubcategories").innerHTML = "";
}
