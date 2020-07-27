// $(document).ready(function(){

//      var _URL = window.URL || window.webkitURL;

//      $('#file').change(function () {
//          var file  =  $(this)[0].files[0];

//          img = new Image();
//          var imgwidth = 0;
//          var imgheight = 0;
//          var maxwidth = 640;
//          var maxheight = 640;

//          img.src = _URL.createObjectURL(file);
//          img.onload = function() {
//              imgwidth = this.width;
//              imgheight = this.height;
             
//              $("#width").text(imgwidth);
//              $("#height").text(imgheight);
//              if(imgwidth <= maxwidth && imgheight <= maxheight){
                 
//                 //  var formData = new FormData();
//                 //  formData.append('fileToUpload', $('#file')[0].files[0]);



//                  //function readURL(input) {

//                     if (input.files && input.files[0]) {
//                         var reader = new FileReader();
                
//                         reader.onload = function(e) {
//                           $('#blah').attr('src', e.target.result);
//                         }
                
//                         reader.readAsDataURL(input.files[0]);
//                     }
//                     //}
                
//                     $("#imgInp").change(function() {
//                       readURL(this);
//                     });
//                 //  $.ajax({
//                 //      //url: 'upload_image.php',
                     
// 				// 	 url: '<?php echo base_url()."index.php/SocietyController/upload_image"?>',
//                 //      type: 'POST',
//                 //      data: formData,
//                 //      processData: false,
//                 //      contentType: false,
//                 //      dataType: 'json',
//                 //      success: function (response) {
//                 //          if(response.status == 1){
//                 //              // Setting Image for Preview
//                 //              $("#prev_img").attr("src","upload/"+response.returnText);
//                 //              $("#prev_img").show();
//                 //              $("#response").text("Upload successfully");
//                 //          }else{
//                 //              $("#response").text(response.returnText);
//                 //          } 
//                 //      }
//                 //  });
//                  alert('hello');
//              }else{
//                  $("#response").text("Image size must be "+maxwidth+"X"+maxheight);
//              }
//          };
//          img.onerror = function() {             
//              $("#response").text("not a valid file: " + file.type);
//          }

//      });
//  });
 
