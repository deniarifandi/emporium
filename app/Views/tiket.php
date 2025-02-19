<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <script type="text/javascript" src="jquery.min.js"></script>
    <script type="text/javascript" src="qrcode.min.js"></script>
</head>
<body style="background-color:rgb(9, 23, 66); color: white; background-image: url(<?php echo base_url() ?>bgtiket.png); background-repeat: no-repeat; background-position: center; background-attachment: fixed; background-size: 500px">

  <style>

.center {
  margin: auto;
  width: 100%;
  border: 3px solid white;
  padding: 6px;
}
  </style>

<div class="container" >
    <div class="row">
        <div class="col-md-12">
    <br>
<!-- Pills content -->
<div class="tab-content">
  <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
    <form>
        <div class="text-center mb-3 h-100 align-middle">
          <!-- Email input -->
        
          <!-- <h5>Berikut terlampir tiket Event XXXXX</h5> -->
          
          <div class="row">
                <div class="col-md-6">
                  <img src="logotiket.png" style="max-width:100px">
                </div>

                <div class="col-md-6">
                  <br>
                  <h5>This is Your</h5>
                  <h2>E-Ticket</h2>
                </div>
          </div>
          <br>
          <div class="row">
              <div class="col-md-12 px-5">
                  <h6>PLEASE HAVE READY ON YOUR DEVICE/THIS BARCODE TO PRESENT FOR SCANNING</h6>
              </div>
          </div>
          
          <br>
           <div class="row">
                <div class="col-md-8" style="text-align: left; padding-left: 50px; padding-right: 50px;">
                    <h6 class="text-secondary">EVENT TITLE</h6>
                    <h5><b>Emporium Bussiness Competition 2025 </b></h5><br>
                    <h6 class="text-secondary">EVENT Date and Time</h6>
                    <h5><b>Jumat, 21 Februari 2025  - Sabtu, 22 Februari 2025 </b></h5>
                    <h6 class="text-secondary">Venue</h6>
                    <h5><b>National Leader School's Hall<br>
                    Jl. Lembah Dieng no. 7 Sukun, Malang</b></h5>
                    <h6 class="text-secondary">Ticket No.</h6>
                    <h5><b><?php echo $result[0]->ticket_no; ?></b></h5>
                    <h6 class="text-secondary">Guest Name</h6>
                    <h5><b><?php echo $result[0]->nama; ?></b></h5>
                </div>
                <div class="col-md-4 align-items-center">
                  <h6 class="text-white">Ticket Barcode:</h6>
                  <!-- <img src="barcode.jpg" style="max-width:250px" class="border border-black p-3"> -->
                  <div id="qrcode" style="width: 250px; height:250px" class="center"></div>
                  <h5><b><?php echo $result[0]->ticket_no; ?></b></h5>
                </div>
                           </div>

        </div>
    </form>
  </div>
</div>
<!-- Pills content -->
        </div>
    </div>
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script type="text/javascript">

var qrcode = new QRCode(document.getElementById("qrcode"), {
      width : 230,
      height : 230
  });

  $(document).ready(function () {
  
    var elText = "<?php echo base_url()."tiket?no=".$result[0]->ticket_no ?>";
    
    qrcode.makeCode(elText);

  });

  
</script>
</html>
