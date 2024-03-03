var segmentTerakhir = window.location.href.split("/").pop();

$.getJSON(window.location.origin + '/other_profile/getProfilePublic/' + segmentTerakhir, function (res) {
    console.log(res);
    $('#username').html(res.dataUser.username);
    $('#bio').html(res.dataUser.bio);
    $('#pictures').prop('src', '/unggah/' + res.dataUser.pictures);
    $('#followers').html(res.jumlahFollower[0].jmlfollower + ' Followers')
    $('#following').html(res.jumlahFollowing[0].jmlfollowing + ' Following')
    if (res.dataUserActive == res.dataUser.id) {
        $('#tombolfollow').html('');
    } else {
        if (res.dataFollow == null) {
            $('#tombolfollow').html('<button class="px-4 mt-4 bg-gray-200 rounded-full" onclick="ikuti(this, ' + res.dataUser.id + ')"> Follow </button>');
        } else {
            $('#tombolfollow').html('<button class="px-4 mt-4 bg-gray-200 rounded-full" onclick="ikuti(this, ' + res.dataUser.id + ')"> Following </button>');
        }
    }
});


var paginate = 1;
var dataExplore = [];
loadMoreData(paginate);
$(window).scroll(function(){
    if($(window).scrollTop() + $(window).height() >= $(document).height()){
        paginate++;
        loadMoreData(paginate);
    }
})
function loadMoreData(paginate){
    let user_id = $('#input-user_id').val();
    $.ajax({
        url: window.location.origin +'/getDataPublic/'+ user_id + '?page='+paginate,
        type: "GET",
        dataType: "JSON",
        success: function(e){
            console.log(e)
            //sort the data in descending order based on the created_at property
            e.data.data.sort((a,b) => new Date(b.created_at) - new Date(a.created_at));
            e.data.data.map((x)=>{
             //format tanggal
             var tanggal = x.created_at;
             var tanggalObj = new Date(tanggal);
             var tanggalFormatted = ('0' + tanggalObj.getDate()).slice(-2);
             var bulanFormatted = ('0' + (tanggalObj.getMonth() + 1)).slice(-2);
             var tahunFormatted = tanggalObj.getFullYear();
             var tanggalupload = tanggalFormatted + '-' + bulanFormatted + '-' + tahunFormatted;
             var hasilPencarian = x.like.filter(function(hasil){
                 return hasil.user_id === e.idUser
             })
             if(hasilPencarian.length <= 0){
                 userlike = 0;
             } else {
                 userlike = hasilPencarian[0].user_id;
             }
             let datanya = {
                 id: x.id,
                 judul_foto: x.judul_foto,
                 deskripsi_foto: x.deskripsi_foto,
                 foto: x.lokasi_file,
                 created_at: tanggalupload,
                 username: x.users.username,
                 foto_profil: x.users.pictures,
                 jml_komentar: x.komentar_count,
                 jml_like: x.like_count,
                 idUserLike: userlike,
                 jml_follow: x.jml_follow,
                 useractive: e.idUser,
                 user_id: x.user_id,
             }
             dataExplore.push(datanya)
             console.log(userlike)
             console.log(e.idUser)
         })
         getExplore()
     },
     error: function(jqXHR, textStatus, errorThrown){

     }
 })
}

//pengulangan data
const getExplore =() => {
    $('#publicfoto').html('')
    dataExplore.map((x, i)=>{
        $('#publicfoto').append(
            `
            <div class="flex mt-2 shadow-xl rounded-md transition duration-500 ease-in-out hover:scale-105 bg-white">
                <div class="flex flex-col">
                    <a href="/explore_detail/${x.id}">
                        <div class="w-[363px] h-[192px] mt-2 px-2 overflow-hidden">
                            <img src="/unggah/${x.foto}" alt="" class="w-full rounded-md" />
                        </div>
                    </a>
                    <div class="flex flex-wrap items-center justify-between px-2 mt-2">
                        <div>
                            <div class="flex flex-col">
                                <div class="font-poppins">${x.deskripsi_foto}</div>
                                    <div class="text-xs text-gray-300 mb-2">${x.created_at}</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <a href="/explore_detail/${x.id}">
                            <small class="text-sm">${x.jml_komentar}</small>
                            <span class="bi bi-chat"></span></a>
                            <span class="text-sm">${x.jml_like}</span>
                            <span class="${x.idUserLike === x.useractive ? 'bi-heart-fill' : 'bi-heart'}" onclick="like(this, ${x.id})"></span>
                        </div>
                </div>
            </div>
            </div>
            `
            )
        });
    }

     // like foto
     function like(txt, id){
        $.ajax({
            url: window.location.origin + '/like',
            dataType: "JSON",
            type: "POST",
            data: {
                _token: $('input[name="_token"]').val(),
                idfoto: id
            },
            success: function(res){
                console.log(res)
                location.reload()

            },
            error: function(jqXHR, textStatus, errorThrown){

            }
        })
    }


//follow
function ikuti(txt, idfollow){
    $.ajax({
        url: window.location.origin +'/explore_detail/ikuti',
        type: "POST",
        dataType: "JSON",
        data: {
            idfollow: idfollow,
            _token: $('input[name="_token"]').val()
        }, success: function(res){
            location.reload()
        }, error: function(jqXHR, textStatus, errorThrown){
            alert('gagal');
        }
    })
}
