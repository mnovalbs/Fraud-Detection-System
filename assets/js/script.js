  var pesanan = {
    kota_asal : "",
    kota_tujuan : "",
    nama_pemesan : "",
    email : "",
    tgl_berangkat : "",
    passenger_adult : 0,
    passenger_child : 0,
    passenger_infant : 0,
    maskapai : "",
    harga : "",
    kunci : "",
    ipaddress : "",
    cc_name : "",
    cc_number : "",
  }
  var form_penumpang = '';
  $.get(base_url('home/form_penumpang'),function(data){
    form_penumpang = data;
  });

  $(".kota").ready(function(){

    $.ajax({
      url : base_url('assets/js/penerbangan.json'),
      dataType : 'json',
      success : function(data){
        var selBaru = '';
        $.each(data, function(index, element){
          var kode = element.code;
          var nama = element.name;
          var lokasi = element.location;
          var negara = element.airportCountry;

          if(negara == 'Indonesia'){
            selBaru += "<option value='"+kode+"'>"+lokasi+" ("+kode+") - "+nama+" </option>";
          }
        });
        $(".kota").html(selBaru);
      }
    });

  });

  $(".maskapai").ready(function(){
    $.ajax({
      url : base_url('assets/js/maskapai.json'),
      dataType : 'json',
      success : function(data){
        $.each(data, function(index, element){
          $('.maskapai').append("<option value='"+index+"'>"+element+"</option>");
        });
      }
    });
  });

  $(".maskapai").change(function(){
    var maskapai = $('.maskapai').val();
    var harga_random = Math.random() * 1000000;
    var passenger_adult = parseInt( $("#penumpang_dewasa").val() );
    var passenger_child = parseInt( $("#penumpang_anak").val() );
    var total_passenger = passenger_child+passenger_adult;

    harga_random = Math.ceil(harga_random) * total_passenger;

    if(maskapai){
      $("#harga").val(harga_random);
    }else{
      $("#harga").val('');
    }
  });

  $(window).bind("load resize", function(){
    var tinggi_layar = $(window).height();
    if(tinggi_layar > $(".middle-center").height()){
      $(".middle-center").css('top', (tinggi_layar-$(".middle-center").height())/2 - 30 );
    }
  });

  function order()
  {
    var nama_pemesan = $("#nama_pemesan").val();
    var email_pemesan = $("#email_pemesan").val();
    var passenger_adult = parseInt( $("#penumpang_dewasa").val() );
    var passenger_child = parseInt( $("#penumpang_anak").val() );
    var passenger_infant = parseInt( $("#penumpang_bayi").val() );
    var kota_asal = $("#kota_asal").val();
    var kota_tujuan = $("#kota_tujuan").val();
    var tanggal = $("#tanggal_berangkat").val();
    var harga = parseInt($("#harga").val());
    var maskapai = $("#maskapai").val();
    var benar = 1;
    var ipaddress = $("#ipaddress").val();

    if( (passenger_adult > 0 && passenger_adult < 8) && (passenger_child >= 0 && passenger_child <= 6) && (passenger_infant >= 0 && passenger_infant <= 4)){

    }else{
      benar = 0;
      alert("Passenger tidak sesuai");
    }

    if(!nama_pemesan){
      benar = 0;
      alert("Nama pemesan harus terisi");
    }

    if(!email_pemesan){
      benar = 0;
      alert("Email harus terisi");
    }

    if(harga <= 0){
      benar = 0;
      alert("Something went wrong!");
    }

    if(!maskapai){
      benar = 0;
      alert("Pilih maskapai!");
    }

    // if(!ipaddress){
    //   benar = 0;
    //   alert("Isikan IP Address");
    // }

    $.ajax({
      url : base_url('json/is_valid_ip/'+ipaddress),
      dataType : 'json',
      success : function(data){
        if(!data){
          benar = 0;
          alert("IP Address tidak valid");
        }

        if(benar == 1){
          var diEncrypt = Date.now()+(Math.random()*1000);
          pesanan.kota_asal = kota_asal;
          pesanan.kota_tujuan = kota_tujuan;
          pesanan.tgl_berangkat = tanggal;
          pesanan.passenger_adult = passenger_adult;
          pesanan.passenger_child = passenger_child;
          pesanan.passenger_infant = passenger_infant;
          pesanan.ipaddress = ipaddress;
          pesanan.nama_pemesan = nama_pemesan;
          pesanan.email = email_pemesan;
          pesanan.kunci = SHA1(diEncrypt.toString());
          pesanan.harga = harga;
          pesanan.maskapai = maskapai;
          $("#form-penumpang").fadeIn();
          $("#form-order").fadeOut();

          for(i=1;i<=pesanan.passenger_adult;i++){
            $("#form-penumpang").append("<h3>Penumpang Dewasa "+i+"</h3>");
            $("#form-penumpang").append("<div class='penumpang' tipe='1'>"+form_penumpang+"</div>");
          }

          for(i=1;i<=pesanan.passenger_child;i++){
            $("#form-penumpang").append("<h3>Penumpang Anak "+i+"</h3>");
            $("#form-penumpang").append("<div class='penumpang' tipe='2'>"+form_penumpang+"</div>");
          }

          for(i=1;i<=pesanan.passenger_infant;i++){
            $("#form-penumpang").append("<h3>Penumpang Bayi "+i+"</h3>");
            $("#form-penumpang").append("<div class='penumpang' tipe='3'>"+form_penumpang+"</div>");
          }

          $("#form-penumpang").append("<button type='button' onclick='checkout()' class='btn btn-order'>Checkout</button>");

        }

      }
    });

  }

  function checkout(){
    var valid = 1;

    $(".penumpang").each(function(){
      var tipe = $(this).attr('tipe');
      var title_penumpang = $(this).find('.title_penumpang').val();
      var nama_penumpang = $(this).find('.nama_penumpang').val();
      var tanggal_lahir = $(this).find('.tanggal_lahir').val();
      var bulan_lahir = $(this).find('.bulan_lahir').val();
      var tahun_lahir = $(this).find('.tahun_lahir').val();

      if( !tipe || !title_penumpang || !nama_penumpang || !tanggal_lahir || !bulan_lahir || !tahun_lahir ){
        valid = 0;
      }

    });

    if(valid==1){
      $.ajax({
        url : base_url('customer/add_detail_order'),
        type : 'POST',
        data : {order_key:pesanan.kunci,nama_pemesan:pesanan.nama_pemesan,harga:pesanan.harga,email:pesanan.email,kota_asal:pesanan.kota_asal,kota_tujuan:pesanan.kota_tujuan,tanggal_berangkat:pesanan.tgl_berangkat,airline:pesanan.maskapai,ipaddress:pesanan.ipaddress},
        dataType : 'json',
        success : function(data){
          // console.log(data);
          if(data.status == 'FAIL'){
            $.each(data.error, function(index, element){
              console.log(element);
            });
          }else{
            add_penumpang();
          }
        }
      });
    }

  }

  function add_penumpang()
  {
    var berhasil_penumpang = 1;
    var arr_penumpang = [];
    $(".penumpang").each(function(){
      var tipe = $(this).attr('tipe');
      var title_penumpang = $(this).find('.title_penumpang').val();
      var nama_penumpang = $(this).find('.nama_penumpang').val();
      var tanggal_lahir = $(this).find('.tanggal_lahir').val();
      var bulan_lahir = $(this).find('.bulan_lahir').val();
      var tahun_lahir = $(this).find('.tahun_lahir').val();

      var penumpang = {
        key : pesanan.kunci,
        tipe : tipe,
        title : title_penumpang,
        nama : nama_penumpang,
        tanggal_lahir : tanggal_lahir,
        bulan_lahir : bulan_lahir,
        tahun_lahir : tahun_lahir,
      }

      arr_penumpang.push(penumpang);

    });

    $.ajax({
      url : base_url('customer/tambah_penumpang'),
      type : 'POST',
      // dataType : 'json',
      data : {penumpang:arr_penumpang},
      success : function(data){
        // console.log(data);
        // if(data.status == 'FAIL'){
        //   berhasil_penumpang = 0;
        //   $.each(data.error, function(index, element){
        //     console.log(element);
        //   });
        // }
        $("#form-pembayaran").fadeIn();
        $("#form-penumpang").fadeOut();
      }
    });
  }

  function cc_check()
  {
    var cc_name = $("#nama_cc").val();
    var cc_number = $("#nomor_cc").val();
    var cc_month = $("#bulan_cc").val();
    var cc_year = $("#tahun_cc").val();
    var cc_cvv = $("#cvv_cc").val();

    if( cc_name && cc_number && cc_month && cc_year && cc_cvv ){
      pesanan.cc_name = cc_name;
      pesanan.cc_number = cc_number;

      $.ajax({
        url : base_url('fds/score_card_check'),
        type : 'POST',
        data : {key:pesanan.kunci,email:pesanan.email,ip:pesanan.ipaddress,cc:pesanan.cc_number,harga:pesanan.harga,nama_pemesan:pesanan.nama_pemesan,nama_cc:pesanan.cc_name},
        dataType : 'json',
        success : function(data){
          if(data.status=='OK'){
            alert(data.cc_status);
            console.log("Fraud Score : "+data.fraud_score);
            $.each(data.pesan_fraud, function(index, element){
              console.log(element);
            });
          }else{
            alert("Pesanan Gagal!");
            $.each(data.error, function(index,element){
              console.log(element);
            });
          }
        }
      });

    }else{
      alert("Semua data Credit Cart wajib terisi!");
    }
  }

  // $("body").bind("DOMSubtreeModified", function() {
  //
  // });

  $("#ipaddress_list").ready(function(){
    $.ajax({
      url : base_url('json/get_recorded_ip'),
      dataType : 'json',
      success : function(data){
        $.each(data, function(index, element){
          $("#ipaddress_list").append("<option value='"+element.ip_address+"'>");
        });
      }
    });
  });


  function SHA1(msg) {
    function rotate_left(n,s) {
      var t4 = ( n<<s ) | (n>>>(32-s));
      return t4;
    };
    function lsb_hex(val) {
      var str="";
      var i;
      var vh;
      var vl;
      for( i=0; i<=6; i+=2 ) {
        vh = (val>>>(i*4+4))&0x0f;
        vl = (val>>>(i*4))&0x0f;
        str += vh.toString(16) + vl.toString(16);
      }
      return str;
    };
    function cvt_hex(val) {
      var str="";
      var i;
      var v;
      for( i=7; i>=0; i-- ) {
        v = (val>>>(i*4))&0x0f;
        str += v.toString(16);
      }
      return str;
    };
    function Utf8Encode(string) {
      string = string.replace(/\r\n/g,"\n");
      var utftext = "";
      for (var n = 0; n < string.length; n++) {
        var c = string.charCodeAt(n);
        if (c < 128) {
          utftext += String.fromCharCode(c);
        }
        else if((c > 127) && (c < 2048)) {
          utftext += String.fromCharCode((c >> 6) | 192);
          utftext += String.fromCharCode((c & 63) | 128);
        }
        else {
          utftext += String.fromCharCode((c >> 12) | 224);
          utftext += String.fromCharCode(((c >> 6) & 63) | 128);
          utftext += String.fromCharCode((c & 63) | 128);
        }
      }
      return utftext;
    };
    var blockstart;
    var i, j;
    var W = new Array(80);
    var H0 = 0x67452301;
    var H1 = 0xEFCDAB89;
    var H2 = 0x98BADCFE;
    var H3 = 0x10325476;
    var H4 = 0xC3D2E1F0;
    var A, B, C, D, E;
    var temp;
    msg = Utf8Encode(msg);
    var msg_len = msg.length;
    var word_array = new Array();
    for( i=0; i<msg_len-3; i+=4 ) {
      j = msg.charCodeAt(i)<<24 | msg.charCodeAt(i+1)<<16 |
      msg.charCodeAt(i+2)<<8 | msg.charCodeAt(i+3);
      word_array.push( j );
    }
    switch( msg_len % 4 ) {
      case 0:
        i = 0x080000000;
      break;
      case 1:
        i = msg.charCodeAt(msg_len-1)<<24 | 0x0800000;
      break;
      case 2:
        i = msg.charCodeAt(msg_len-2)<<24 | msg.charCodeAt(msg_len-1)<<16 | 0x08000;
      break;
      case 3:
        i = msg.charCodeAt(msg_len-3)<<24 | msg.charCodeAt(msg_len-2)<<16 | msg.charCodeAt(msg_len-1)<<8  | 0x80;
      break;
    }
    word_array.push( i );
    while( (word_array.length % 16) != 14 ) word_array.push( 0 );
    word_array.push( msg_len>>>29 );
    word_array.push( (msg_len<<3)&0x0ffffffff );
    for ( blockstart=0; blockstart<word_array.length; blockstart+=16 ) {
      for( i=0; i<16; i++ ) W[i] = word_array[blockstart+i];
      for( i=16; i<=79; i++ ) W[i] = rotate_left(W[i-3] ^ W[i-8] ^ W[i-14] ^ W[i-16], 1);
      A = H0;
      B = H1;
      C = H2;
      D = H3;
      E = H4;
      for( i= 0; i<=19; i++ ) {
        temp = (rotate_left(A,5) + ((B&C) | (~B&D)) + E + W[i] + 0x5A827999) & 0x0ffffffff;
        E = D;
        D = C;
        C = rotate_left(B,30);
        B = A;
        A = temp;
      }
      for( i=20; i<=39; i++ ) {
        temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0x6ED9EBA1) & 0x0ffffffff;
        E = D;
        D = C;
        C = rotate_left(B,30);
        B = A;
        A = temp;
      }
      for( i=40; i<=59; i++ ) {
        temp = (rotate_left(A,5) + ((B&C) | (B&D) | (C&D)) + E + W[i] + 0x8F1BBCDC) & 0x0ffffffff;
        E = D;
        D = C;
        C = rotate_left(B,30);
        B = A;
        A = temp;
      }
      for( i=60; i<=79; i++ ) {
        temp = (rotate_left(A,5) + (B ^ C ^ D) + E + W[i] + 0xCA62C1D6) & 0x0ffffffff;
        E = D;
        D = C;
        C = rotate_left(B,30);
        B = A;
        A = temp;
      }
      H0 = (H0 + A) & 0x0ffffffff;
      H1 = (H1 + B) & 0x0ffffffff;
      H2 = (H2 + C) & 0x0ffffffff;
      H3 = (H3 + D) & 0x0ffffffff;
      H4 = (H4 + E) & 0x0ffffffff;
    }
    var temp = cvt_hex(H0) + cvt_hex(H1) + cvt_hex(H2) + cvt_hex(H3) + cvt_hex(H4);

    return temp.toLowerCase();
  }
