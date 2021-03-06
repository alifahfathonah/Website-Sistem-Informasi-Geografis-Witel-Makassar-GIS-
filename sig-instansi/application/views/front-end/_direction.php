      

      <div class="col-md-12 content" style="padding-right:10px;padding-top:0;">
        <div class="panel">
          <div class="panel-heading">
            <h3 class="panel-title">Cari Rute (Direction)</h3>
          </div>
          <div class="panel-body" style="padding:0;">
            <form class="form-inline" action="<?=base_url().'web/direction' ?>" method="POST" style="padding:10px 0;">
              <input type="text" name='asal' class="form-control" placeholder="Alamat asal" required="">
              <input type="text"  name='tujuan' class="form-control" placeholder="Alamat Yang dituju" required="">
              <button type="submit" name="cari" class="btn btn-warning btn-flat"><i class="fa fa-map-marker"></i> Rute</button>
            </form>

            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDj-hFGBMNwgXz91WdQn5O1N6mgxKJcX1U&callback=initMap"></script>
                  
                  <script>
                    
                    var marker;
                      function initialize() {
                      
                    // Variabel untuk menyimpan informasi (desc)
                    var infoWindow = new google.maps.InfoWindow;
                    
                    //  Variabel untuk menyimpan peta Roadmap
                    var mapOptions = {
                          mapTypeId: google.maps.MapTypeId.ROADMAP
                        } 
                    
                    // Pembuatan petanya
                    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
                              
                        // Variabel untuk menyimpan batas kordinat
                    var bounds = new google.maps.LatLngBounds();

                    // Pengambilan data dari database
                          <?php
                          $as = $this->db->query("SELECT l.id, l.sid, l.no_order, l.nama_odp, l.port, l.sn_ont, l.alamat, l.latittude, l.longitude, k.nama_kategori, k.ikon FROM lokasi_ccan_fulfillment as l, kategori as k WHERE l.kategori=k.id");
                          foreach ($as->result() as $data) {
                          $sid   = $data->sid;
                          $no_order   = $data->no_order;
                          $nama_odp   = $data->nama_odp;
                          $port   = $data->port;
                          $sn_ont   = $data->sn_ont;
                          $alamat   = $data->alamat;
                          $lat    = $data->latittude;
                          $lon    = $data->longitude;
                          $icon   = $data->ikon;
                          ?>

                          var image = "<?php echo base_url().'uploads/icon/'.$icon ?> ";

                          <?php

                          echo ("addMarker($lat, $lon, '<b>$sid</b><br>$alamat');\n");
                          }

                          ?>
                      
                    // Proses membuat marker 
                    function addMarker(lat, lng, info) {
                      var lokasi_ccan_fulfillment = new google.maps.LatLng(lat, lng);
                      bounds.extend(lokasi_ccan_fulfillment);
                      var image = "<?=base_url().'uploads/icon/townhouse.png' ?> ";
                      var marker = new google.maps.Marker({
                        map: map,
                        position: lokasi_ccan_fulfillment,
                        icon:image
                      });       
                      map.fitBounds(bounds);
                      bindInfoWindow(marker, map, infoWindow, info);
                     }
                    
                    // Menampilkan informasi pada masing-masing marker yang diklik
                        function bindInfoWindow(marker, map, infoWindow, html) {
                          google.maps.event.addListener(marker, 'click', function() {
                            infoWindow.setContent(html);
                            infoWindow.open(map, marker);
                          });
                        }
                 
                        }
                      google.maps.event.addDomListener(window, 'load', initialize);
                    
                  </script>
                  <div id="map-canvas" style="width: auto; height: 600px;"></div>

          </div>
        </div>
      </div>
      <!-- ./CONTENT -->

      
