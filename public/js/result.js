function initialize() {
  geocoder = new google.maps.Geocoder();
  var latlng = new google.maps.LatLng(37.0547, 135.5936);
  var mapOptions = {
      zoom: 4.5,
      center: latlng
  }
  map = new google.maps.Map(document.getElementById('map'), mapOptions);
}

  var geocoder;//住所から座標を取得
  var latlng;//住所から緯度経度を取得
  var map;
  var marker = [];
  let addressArray = [];
  var addressesData = document.getElementsByClassName('address');
  const addresses = Array.from(addressesData);
  addresses.forEach(function(address) {
      if(address.innerText !== ""){
          var element = address.innerText;
      addressArray.push(element);
      }
  });
  //console.log(addressArray);

function initMap() {

  initialize();//マップの初期化

  for (let i = 0; i < addressArray.length; i++) {//ピンを多数立てるためにリストの数だけ回す
      geocoder.geocode({
          "address" : addressArray[i]
      }, function(results, status) { // 結果
          if (status === google.maps.GeocoderStatus.OK) { // ステータスがOKの場合
              let bounds = new google.maps.LatLngBounds();
              latlng = results[0].geometry.location;
              bounds.extend(latlng);

              //簡易的にしていますが本来はマップの中心に持ってきたい座標でのみmap.setCenter(latlng);をするべきだと思います。
              if(i === 0){
                  map.setCenter(latlng);
              }

              //マーカーを立てる
              marker[i] = new google.maps.Marker({
                  position: latlng,
                  map: map
              });

          } else { // 失敗した場合
              console.group('Error');
              console.log(results);
              console.log(status);
          }

      });
  }
}