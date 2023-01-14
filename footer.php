<!-- TASK: OPTIONAL TASK  -->

<!-- If WE like, WE can put a page footer (something that should show up at
     the bottom of every page, such as helpful links, layout, etc.) here. -->

<!-- REFERENCE: FUNCTION1: BACK TO TOP
                FUNCTION2: COPYRIGHT AND OTHER INFORMATION
                FUNCTION3: COVE THE FUNCTIONOF NEXT PAGE 
-->
<?php
$startYear = 2020;
$thisYear = date('Y');
if ($thisYear > $startYear) {
     $thisYear = date('y');
     $copyright = "$startYear&ndash;$thisYear";
} else {
     $copyright = $startYear;
}
?>
<div id="footer">
     <div class="container" style="margin-top: 100px;">
          <div class="row">
               <div class="col-sm-2">
                    <p id="copyright" class="reset pull_out padding" role="contentinfo"><a href="browse.php">© <?php echo $copyright; ?> Bid Burr</a></p>
               </div>
               <div class="col-sm-10">
                    <p id="disclaimer"> Bid Burr is a an online auction company founded in 2020 that allows users to both purchase and sell products efficiently, reliably and safely.</p>
               </div>
          </div>
     </div>

</div>