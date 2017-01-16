<?php
  $this->load->view('header');

  $this->load->view('form/form_order');

  ?>
  <div id='form-penumpang' class='form-ungu center-middle'></div>

  <div id='form-pembayaran' class='form-ungu center-middle'>
    <?php
      $this->load->view('form/form_cc');
    ?>
  </div>

  <div id='pesan'></div>

  <?php

  $this->load->view('footer');
?>
