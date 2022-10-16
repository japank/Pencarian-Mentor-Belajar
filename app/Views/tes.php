<?= $this->extend('layout/template') ?>
<?= $this->section('content'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" rel="stylesheet" />

<br><br><br><br>
<input type="textarea" readonly id="Txt_Date" placeholder="Choose Date" value="2022-10-10,2022-10-11,2022-10-12" style="cursor: pointer;">

<script>
  $("#Txt_Date").datepicker({
    format: 'yyyy-mm-dd',
    inline: false,
    lang: 'en',
    step: 5,
    multidate: 5,
    closeOnDateSelect: true
  });

  console.log(Txt_Date);
</script>
<?= $this->endSection('content'); ?>