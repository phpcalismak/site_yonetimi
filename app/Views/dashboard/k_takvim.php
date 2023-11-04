<?= $this->extend('layout/admin_template') ?>
<?= $this->section('content') ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!--fullcalendar plugin files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    
    <!-- for plugin notification -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  
<div class="container">
    <h3 style="text-align: center">Etkinlik Takvimi</h3>
    <div id="calendar"></div>
</div>
   

<?= $this->endSection('content') ?>

<?= $this->section('pageSpecificScript') ?>
<script>
 
$(document).ready(function() {


    var calendar = $('#calendar').fullCalendar({
        editable: false, // Disable editing
        events: "<?= base_url('event') ?>",
        displayEventTime: false,
        eventRender: function(event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        }
    });
});



</script>

  <?= $this->endSection('pageSpecificScript') ?>
