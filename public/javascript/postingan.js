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
        url: window.location.origin +'/getDataPostingan'+ '?page='+paginate,
        type: "GET",
        dataType: "JSON",
        success: function(e){
            console.log(e)
            //sort the data in descending order based on the created_at property
            e.data.data.sort((a,b) => new Date(b.created_at) - new Date(a.created_at));
            e.data.data.map((x)=>{
                //Format Tanggal
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

    const getExplore =() => {
        $('#postingandata').html('')
        dataExplore.map((x, i)=>{
            $('#postingandata').append(
                `
                <div class="flex mt-2 shadow-xl rounded-md transition duration-500 ease-in-out hover:scale-105 bg-white">
                                <div class="flex flex-col">
                                    <a href="/explore_detail/${x.id}">
                                        <div class="w-[363px] h-[192px] mt-2 px-2 overflow-hidden">

                                                <img src="/unggah/${x.foto}" alt=""
                                                    class="w-full rounded-md" />

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
                                            <i class="bi bi-trash btn-delete-foto" data-id="${x.id}"></i>
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
//hapus
$(document).on('click', '.btn-delete-foto', function() {
    console.log('Tombol Hapus Diklik');
    var id = $(this).data('id');

    // Show loading spinner or change appearance immediately
    $('#elemen-foto-' + id).addClass('deleting');

    if (confirm('Apakah Anda yakin ingin menghapus postingan ini?')) {
        deletefoto(id);
    }

    function deletefoto(id) {
        $.ajax({
            url: '/deletefoto/' + id,
            dataType: "JSON",
            type: "DELETE",
            data: {
                _token: $('input[name="_token"]').val(),
                id: id
            },
            success: function(res) {
                if (res.success) {
                    // Hapus elemen postingan dari tampilan
                    $('#elemen-foto-' + id).remove();
                    // Refresh the page
                    location.reload();
                } else {
                    alert('Gagal menghapus postingan');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Gagal menghapus postingan');
            },
            complete: function() {
                // Remove loading spinner or revert appearance
                $('#elemen-foto-' + id).removeClass('deleting');
            }
        });
    }
});
