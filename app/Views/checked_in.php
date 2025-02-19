<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body style="background-color:rgb(9, 23, 66); color: white; background-image: url(<?php echo base_url() ?>bgtiket.png); background-repeat: no-repeat; background-position: center; background-attachment: fixed; background-size: 500px">

<div class="container" >
    <div class="row">
        <div class="col-md-12">
    <br><br>
<!-- Pills content -->
<div class="tab-content">
  <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
    <form>
      <div class="text-center mb-3 h-100 align-middle">
      <!-- Email input -->
      
      <h2 class="text-white">Checked-In</h2>
<br><br>
    <img src="<?php echo base_url()?>check.png" style="max-width: 250px;">
      <br><br><br>
      <h6>Guest:</h6>
      <h2><?php echo $result[0]->nama; ?></h2>
      <h6>Occupation:</h6>
      <h2><?php echo $result[0]->occupation; ?></h2>
      <br>
      <button class="btn btn-warning" onclick="closeTab()">Close</button>
      <div data-mdb-input-init class="form-outline mb-4">
        
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

<script>
    
    function closeTab(){
         window.close();
    }

</script>

</html>
