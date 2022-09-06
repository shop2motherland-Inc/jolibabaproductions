// function show_subcategories(id, url) {
//   document.getElementById("showsubcategories").innerHTML = "";
//   var element = document.getElementById(`subcat_id`);
//   var cart = $("#cat_id-" + id);
//   console.log(cart);
//   element.style.top = $(`#cat_id-${id}`).position().top + "px";
//   console.log($(`#cat_id-${id}`).offset().top);
//   let subcat = [];
//   var cat = id;
//   $("#removecat").removeClass("d-none");
//   $.ajax({
//     url: `changeCategorySession/${cat}`,
//     type: "get",
//     success: function (response) {
//       response.forEach((item) => {
//         // Create an "li" node:
//         const node = document.createElement("li");
//         node.classList.add("subcatogorylist", "text-lg");
//         // node.setAttribute("class", "subcatogorylist");
//         node.setAttribute(
//           "style",
//           "border-bottom: #0060ff 1px solid;display:flex;flex-direction:row;align-items:center"
//         );
//         // Create a text node:
//         // const textnode = document.createTextNode(item.name);

//         var span = document.createElement("a");
//         var icon = document.createElement("i");
//         icon.setAttribute(
//           "class",
//           item.icon_class ? item.icon_class : "fas fa-check"
//         );
//         icon.setAttribute(
//           "style",
//           "color:#fff;display:inline-block;margin-left:20px;"
//         );
//         // class="{{ $cat->icon_class ?? 'fas fa-check' }}"

//         span.setAttribute("href", url + "/" + item.slug);
//         span.setAttribute(
//           "style",
//           "color:white;padding:10px  0px 10px 20px;display:inline-block"
//         );
//         // span.className = 'toggle';
//         span.appendChild(document.createTextNode(item.name));

//         // Append the text node to the "li" node:
//         node.appendChild(icon);
//         node.appendChild(span);

//         // Append the "li" node to the list:
//         document.getElementById("showsubcategories").appendChild(node);
//       });
//     },
//     statusCode: {
//       404: function () {
//         // alert('web not found');
//       },
//     },
//     error: function (x, xs, xt) {
//       //nos dara el error si es que hay alguno
//       window.open(JSON.stringify(x));
//       //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
//     },
//   });
// }

// function removeCat() {
//   document.getElementById("showsubcategories").innerHTML = "";
// }

// function show_number() {
//   openLoginModal();
// }