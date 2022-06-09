<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <select id="country">
            <option value="">Select Country</option>
            <option value="UK">UK</option>
            <option value="IRE">IRELAND</option>
        </select>
    </div>
    <br>
    <div>
        <select id="year">
            <option value="">Select Year</option>
        </select>
    </div>
    <hr>
    <p>Financial Year Start : <span id="start"></span></p>
    <p>Financial Year End : <span id="end"></span></p>
    <?php
        function getCountryFinancialYear($country,$year){

        }
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $( document ).ready(function() {
           $('#country').change(function(){
               var country = $(this).val();
               var yearLength = 10;
               var currentYear = new Date().getFullYear();
               $('#year').empty();
               $('#year').append(new Option('Select Financial Year', ''));
               if(country == 'UK'){
                  for(var i = 0; i < yearLength; i++){
                      var next = currentYear + 1;
                      var year = currentYear + '-' + next.toString().slice(-2);
                      $('#year').append(new Option(year, currentYear));
                      currentYear--;
                  }      
               }
               else if(country == 'IRE'){
                  for(var i = 0; i < yearLength; i++){
                      $('#year').append(new Option(currentYear, currentYear));
                      currentYear--;
                  }  
               }
           });

           $('#year').change(function(){
              var year = $(this).val();
              var country = $('#country').val();
              if(year && country){
                $.ajax({
                    url: 'http://localhost/test/function.php',
                    type: 'POST',
                    data : {'country':country,'year':year},
                    success: function (data) {
                        var obj = jQuery.parseJSON(data);
                        $('#start').text(obj.start);
                        $('#end').text(obj.end);
                    }
                });
              }
              else{
                  alert('Choose Country & Financial Year');
              }
           });
        });
    </script>
</body>
</html>