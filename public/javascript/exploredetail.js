var segmentTerakhir = window.location.href.split('/').pop();

$.ajax({
    url: window.location.origin +'/explore_detail/'+ segmentTerakhir +'/getdatadetail',
    type: "GET",
    dataType: "JSON",
    success: function(res){
        console.log(res)
        $('#fotodetail').prop('src', '/unggah/'+res.dataDetailFoto.lokasi_file)
        $('#fotoprofil').prop('src', '/unggah/'+res.dataDetailFoto.users.pictures)
        $('#judulfoto').html(res.dataDetailFoto.judul_foto)
        $('#username').html(res.dataDetailFoto.users.username)
        $('#deskripsifoto').html(res.dataDetailFoto.deskripsi_foto)
        $('#jumlahpengikut').html(res.dataJumlahFollow.jmlfolow + ' Followers')
        ambilKomentar()
        var idUser ;
        if(res.dataFollow == null){
            idUser =""
        } else {
            idUser = res.dataFollow.user_id
        }
        if(res.dataDetailFoto.user_id === res.dataUser){
            $('#tombolfollow').html('')
        } else {
            if(idUser == res.dataUser){
                $('#tombolfollow').html('<button class="px-4 rounded-full bg-gray-200" onclick="ikuti(this, '+res.dataDetailFoto.user_id+')">Unfollow</button>')
            } else {
                $('#tombolfollow').html('<button class="px-4 rounded-full bg-gray-200" onclick="ikuti(this, '+res.dataDetailFoto.user_id+')">Follow</button>')
            }
        }

    },
    error: function(jqXHR, textStatus, errorThrown){
        alert('gagal')
    }
})


function ambilKomentar(){
    $.getJSON(window.location.origin +'/explore_detail/getkomen/'+segmentTerakhir, function(res){
        // console.log(res)
        if(res.data.lenght === 0){
            $('#komentar').html('<div>Belum ada komentar</div>')
        } else {
            komentar= []
            res.data.map((x)=>{
                let datakomentar = {
                    idUser: x.users.id,
                    pengirim: x.users.username,
                    waktu: x.created_at,
                    isikomentar: x.isi_komentar,
                    potopengirim: x.users.pictures,
                }
                komentar.push(datakomentar);
            })
            tampilkankomentar()
        }
    })
}

const tampilkankomentar = ()=>{
    $('#komentar').html('')
    komentar.map((x, i)=>{
        $('#komentar').append(
            `
            <div class="flex flex-row justify-start mt-4">
            <div class="mr-2">
                <img src="/unggah/${x.potopengirim}" class="w-8 h-auto rounded-full" alt="" />
            </div>
            <div class="flex flex-col mr-2">
                <h5 class="text-sm font-poppins">${x.pengirim}</h5>
                <small class="text-xs text-gray-400">${new Date(x.waktu).toLocaleDateString("id")}</small>
            </div>
            <h5 class="text-sm font-poppins">${x.isikomentar}</h5>
        </div>
            `
        )

    })

}

function kirimkomentar(){
    $.ajax({
        url: window.location.origin +'/explore_detail/kirimkomentar',
        dataType: "JSON",
        type: "POST",
        data: {
            _token: $('input[name="_token"]').val(),
            idfoto: segmentTerakhir,
            isi_komentar: $('input[name="textkomentar"]').val()
        },
        success: function(res){
            $('input[name="textkomentar"]').val('')
            console.log(res)
            location.reload()
            e.data.data.sort((a,b) => new Date(b.created_at) - new Date(a.created_at));

        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('gagal mengirim komentar')
        }
    })
}

// setInterval(ambilKomentar,500);

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

//postinganbawah
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
        url: window.location.origin +'/getDataExplore/'+ '?page' +paginate,
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
    $('#exploredatapostingan').html('')
    dataExplore.map((x, i)=>{
        $('#exploredatapostingan').append(
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
