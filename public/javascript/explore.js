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
    var urlnya = window.location.href.split("?")[1];
    var parameter = new URLSearchParams(urlnya);
    var cariValue = parameter.get('cari')
    if (cariValue == 'null') {
        url = window.location.origin = '/getDataExplore/' + '?page='+paginate;
    } else {
        url = window.location.origin + '/getDataExplore?cari='+ cariValue + '&page='+paginate
    }
    $.ajax({
        // url: window.location.origin +'/getDataExplore/'+ '?page=' +paginate,
        url: url,
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
    $('#exploredata').html('')
    dataExplore.map((x, i)=>{
        $('#exploredata').append(
            `
            <div class="mt-2 shadow-xl rounded-md transition duration-500 ease-in-out hover:scale-105 bg-white">
                    <div class="felx flex-col">
                    <a href="/explore_detail/${x.id}">
                        <div
                            class="w-[360px] h-[192px] overflow-hidden mt-2 px-2">
                                <img src="/unggah/${x.foto}" alt="" class="w-full rounded-md" />
                            </a>
                        </div>
                        <div class="flex flex-wrap items-center justify-between mt-2 px-2">
                            <div>
                                <div class="flex">
                                    <img src="/unggah/${x.foto_profil}" alt="" class="w-8 h-8 rounded-full" />
                                    <a href="/profil_public/${x.user_id}">
                                    <div class="flex flex-col px-2 mb-2">
                                        <a href="/other_profile/${x.user_id}"><span class="font-poppins">${x.username}</span></a>
                                        <span class="text-xs text-gray-300">${x.created_at}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2">
                                <a href="/explore_detail/${x.id}">
                                <small class="text-sm">${x.jml_komentar}</small>
                                <span class="bi bi-chat"></span>
                                </a>
                                <span>${x.jml_like}</span>
                                <span class=" ${x.idUserLike === x.useractive ? 'bi-heart-fill' : 'bi-heart'}" onclick="like(this, ${x.id})"></span>
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
