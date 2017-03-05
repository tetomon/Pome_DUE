<?
if (!file_exists('report_file/Sep_2016')) {
                            echo "<script>alert('not founder exists'); </script>"; 
                            mkdir('report_file/Sep_2016', 0777, true);
                          }
?>