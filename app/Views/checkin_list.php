<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

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
      
      <h2 class="text-primary">Data Peserta Check-In</h2>
      <?php if (isset($_SESSION['check_in'])) {
        ?><h4 class="text-success">ready to check in</h4><?php
      }else{
        ?><h4 class="text-danger">not ready to check in</h4><?php
      }?>

      <!-- <input type="file" accept="image/*;capture=camera"> -->
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>No.Hp</th>
                  <th>E-Mail</th>
                  <th>Occupation</th>
                  <th>Check-In Time</th>
              </tr>
          </thead>
          <tbody>
            <?php for($i = 0; $i < count($admin); $i++){?>
                <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $admin[$i]->nama; ?></td>
                  <td><?php echo $admin[$i]->hp; ?></td>
                  <td><?php echo $admin[$i]->email; ?></td>
                  <td><?php echo $admin[$i]->occupation; ?></td>
                  <td><?php echo $admin[$i]->flag_checkin; ?></td>
                </tr>
            <?php } ?>
          </tbody>
      </table>
          
      
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

</html>
