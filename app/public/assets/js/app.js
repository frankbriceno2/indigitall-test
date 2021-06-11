$(document).ready(function () {
    console.log('Loading resources');
    $(function(){
        var message = $('#liveToast');
        var text_msg = $('.toast-body');
        $.ajax({
            type:'GET',
            url: 'http://127.0.0.1:81/home.php',
            beforeSend: function () {
                console.log('Before');
            },
            success: function (data){
                console.log(data.body);
                var widgetUser = '';
                $.each(data.body, function(index) {
                    //alert(data.body[index].fullname);
                    widgetUser += '<div class="container mt-3 d-flex justify-content-center">'+
                                    '<div class="card p-3 m-2">'+
                                        '<div class="d-flex align-items-center">'+
                                            '<div class="image"><i class="fas fa-user-astronaut fa-9x"></i></div>'+
                                            '<div class="ml-3 p-3 w-100">'+
                                                '<h4 class="mb-0 mt-0">'+data.body[index].fullname+'</h4> <span>'+data.body[index].created_at+'</span>'+
                                                '<div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">'+
                                                    '<div class="d-flex flex-column"> <span class="articles">Language</span> <span class="number1">'+data.body[index].language+'</span> </div>'+
                                                    '<div class="d-flex flex-column"> <span class="followers">Latitude</span> <span class="number2">'+data.body[index].latitude+'</span> </div>'+
                                                    '<div class="d-flex flex-column"> <span class="rating">Longitude</span> <span class="number3">'+data.body[index].longitude+'</span> </div>'+
                                                '</div>'+
                                                '<div class="button mt-2 d-flex flex-row align-items-center"><button id="addFriend" data-id-user='+data.body[index].id_user+' class="btn btn-sm btn-primary w-100 ml-2">Add friend</button> </div>'+
                                                '<div class="button mt-2 d-flex flex-row align-items-center"><button id="deleteUser" data-id-user='+data.body[index].id_user+' class="btn btn-sm btn-danger w-100 ml-2">Delete User</button> </div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                });
                $('#content').append(widgetUser);
                $('.toast-header').addClass('bg-success text-white');
                text_msg.append('Home loaded correctly');
                message.toast('show');
            },
            error: function (xhr) {
                console.log(xhr.statusText + xhr.responseText);
                $('.toast-header').addClass('bg-danger text-white');
                text_msg.append('Somthing is wron');
                message.toast('show');
            },
            complete: function () {
                console.log('Complete');
            }
        });
    });

    $("#registerUser").bind("submit",function(e){
        e.preventDefault();
        var message = $('#liveToast');
        var text_msg = $('.toast-body');
        // Capturamnos el boton de envío
        var formData=$('#registerUser').serializeArray();
        var jsonObj={};
	    for(var i in formData){
            jsonObj[formData[i].name]=formData[i].value;
        }
        $.ajax({
            type: 'POST',
            url: 'http://127.0.0.1:81/user.php?action=insert',
            dataType : 'json',
            data: JSON.stringify(jsonObj),
            contentType : "application/json",
            beforeSend: function(){
            },
            complete:function(data){
            
            },
            success: function(data){
                location.reload();
            },
            error: function(data){
                /*
                * Se ejecuta si la peticón ha sido erronea
                * */
                alert("Send form data has fail");
            }
        });
    });

    $(document).on('click','#deleteUser',function(){
        var id_user = $(this).data('id-user');
        var jsonData = {}
        jsonData['id_user']=id_user;
        console.log(jsonData);
        $.ajax({
            type: 'POST',
            url: 'http://127.0.0.1:81/user.php?action=delete',
            dataType : 'json',
            data: JSON.stringify(jsonData),
            contentType : "application/json",
            beforeSend: function(){
            },
            complete:function(data){
            
            },
            success: function(data){
                location.reload();
            },
            error: function(data){
                /*
                * Se ejecuta si la peticón ha sido erronea
                * */
                alert("Send form data has fail");
            }
        });
    });
});