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
      
      <h2 class="text-success">Data Pendaftaran</h2>
      <a class="btn btn-primary" href="<?php echo base_url()?>checkin_list">Check-In</a>
      <br><br>
      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Relationship</th>
                  <th>E-Mail</th>
                  <th>Occupation</th>
                  
                  <th>Register Time</th>
                  <th>Status Pengiriman Tiket</th>
                  <th>Nomor Tiket</th>
                  <th>Send Ticket</th>
              </tr>
          </thead>
          <tbody>
            <?php for($i = 0; $i < count($admin); $i++){?>
                <tr>
                  <td><?php echo $i+1; ?></td>
                  <td><?php echo $admin[$i]->nama; ?></td>
                  <td><?php echo $admin[$i]->grade; ?></td>
                  <td><?php echo $admin[$i]->email; ?></td>
                  <td><?php echo $admin[$i]->occupation; ?></td>
                  <td><?php echo $admin[$i]->timestamp; ?></td>
                  <td><?php 
                  if ($admin[$i]->flag_tiket == 0) {
                    ?><button class="btn btn-sm btn-danger" disabled>Tiket Belum Dikirim</button><?php
                  }else{
                    ?><button class="btn btn-sm btn-success" disabled>Tiket Sudah Dikirim</button><?php
                  }
                  ?></td>
                  <td><?php echo $admin[$i]->ticket_no; ?></td>
                  <td><a class="btn btn-sm btn-primary" href="<?php echo base_url()?>resend_ticket?nama=<?php echo $admin[$i]->nama; ?>&email=<?php echo $admin[$i]->email?>&no_tiket=<?php echo $admin[$i]->ticket_no ?>">Send Ticket</a></td>
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
