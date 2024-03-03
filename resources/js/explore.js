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
    $.ajax({
        url: window.location.origin +'/getDataExplore/'+ '?page' + paginate,
        type: "GET",
        dataType: "JSON",
        success: function(e){
            console.log(e)
            e.data.data.map((x) => {
                var hasilPencarian = x.like.filter(function(hasil){
                    return hasil.user_id === e.idUser
                })
                if(hasilPencarian.length <= 0){
                    userlike = 0;
                } else {
                    userlike = hasilPencarian[0].user_id;
                }

                // var hasilPencarianFavorite = x.favorite.filter(function(hasil){
                //     return hasil.id_user === e.idUser
                // })
                // if(hasilPencarianFavorite.length <= 0){
                //     userfavorite = 0;
                // } else {
                //     userfavorite = hasilPencarianFavorite[0].user_id;
                // }

                let datanya = {
                    id: x.id,
                    judul: x.judul_foto,
                    deskripsi: x.deskripsi_foto,
                    foto: x.lokasi_file,
                    tanggal: x.created_at,
                    jml_komentar: x.komentar_count,
                    jml_like: x.like_count,
                    idUserLike: userlike,
                    useractive: e.idUser,
                    userFavorite: userfavorite
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
const getExplore = () => {
    $('#exploredata').html('')
    dataExplore.map((x, i) => {
        $('#exploredata').append(
            `
            <div class="mt-2">
            <div class="felx flex-col px-2">
                <div class="w-[360px] h-[192px] overflow-hidden transition duration-500 ease-in-out hover:scale-105">
                    <a href="/explore_detail">
                        <img src="/assets/${x.foto}" alt="" class="w-full rounded-md" />
                    </a>
                </div>
                <div class="flex flex-wrap items-center justify-between mt-2">
                    <div>
                        <div class="flex">
                            <img src="/assets/sipa.jpeg" alt="" class="w-8 h-8 rounded-full" />
                            <div class="flex flex-col px-2">
                                <a href="other_profile.html"><span class="font-poppins">syifanuraini</span></a>
                                <span class="text-xs text-gray-300">14w</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <span class="bi bi-chat"></span>
                        <small>${x.jml_komentar}</small>
                        <span class="bi bi-heart"></span>
                        <small>${x.jml_like}</small>
                    </div>
                </div>
            </div>
        </div>
            `
        )
    })
}
