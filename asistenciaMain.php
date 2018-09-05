<?php include 'templates/top.php'; ?>

<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 maintitle-container">
  <div class="mainlogo-container">
    <i class="fa fa-list-alt"></i>
  </div>
  <div class="maintext-container">
    ASISTENCIAS
  </div>
</div>
<?php include 'templates/bottom.php'; ?>
<script>
function getRule() {
  var rule, cssRule;
  var ss = document.styleSheets;
  //console.log(ss);
  for (var i = 0; i < ss.length; ++i) {
      for (var x = 0; x < ss[i].cssRules.length; ++x) {
          rule = ss[i].cssRules[x];
          //console.log(rule);
          if (rule.name == "wipe" && rule.type== CSSRule.KEYFRAMES_RULE) {
              cssRule = rule;
          }

      }
  }
  return cssRule;

}
</script>
