<?php 
  use \koolreport\core\Utility;
?>
<style>
  .fa {
    cursor: pointer;
  }
  .pivot-row {
    white-space: nowrap;
  }
</style>
<table id=<?=$uniqueId?> class='pivot-table table table-bordered' style='width:<?= $width ?>; display: none'>
	<tbody>
    <?php
      foreach ($colFields as $i => $f)
      {
        ?>
        <tr class='pivot-column'>
          <?php
            if ($i === 0)
            {
              ?>
                <td colspan=<?= count($rowFields); ?>
                    rowspan=<?= count($colFields); ?>>
                  <?php echo implode(' | ', $dataNodes); ?>
                </td>
              <?php
            }
            foreach ($colIndexes as $c => $j)
            {
              $node = $colNodes[$j];
              $nodeMark = $colNodesMark[$j];
              if (isset($nodeMark[$f . '_colspan']))
              {
                ?>
                  <td class='pivot-column-header'
                      data-column-field=<?=$i?>
                      data-column-index=<?=$c;?>
                      data-layer=1
                      rowspan=<?= $nodeMark[$f . '_rowspan']; ?> 
                      colspan=<?= $nodeMark[$f . '_colspan']; ?>>
                    <?php if ($i < count($colFields) - 1 
                        && $node[$f] !== $totalName)  { ?>
                      <i class='fa fa-minus-square-o' aria-hidden='true'
                          onclick='expandCollapseColumn(this, <?= $uniqueId; ?>)'></i>
                    <?php } ?>
                    <?= $node[$f]; ?>
                  </td>
                <?php
              }
            }
          ?>
        </tr>
        <?php
      }
    ?>
		<?php
		foreach($rowIndexes as $r => $i)
		{
      $node = $rowNodes[$i];
      $nodeMark = $rowNodesMark[$i];
      ?>
      <tr class='pivot-row'>
        <?php
        foreach($rowFields as $j => $rf)
        {
          if (isset($nodeMark[$rf . '_rowspan']))
          {
            ?>
              <td class='pivot-row-header'
                  data-row-field=<?=$j?>
                  data-row-index=<?=$r?>
                  data-layer=1
                  rowspan=<?= $nodeMark[$rf . '_rowspan']; ?> 
                  colspan=<?= $nodeMark[$rf . '_colspan']; ?>>
                <?php if ($j < count($rowFields) - 1 
                    && $node[$rf] !== $totalName)  { ?>
                  <i class='fa fa-minus-square-o' aria-hidden='true'
                      onclick='expandCollapseRow(this, <?=$uniqueId?>)'></i>
                <?php } ?>
                <?= $node[$rf]; ?>
              </td>
            <?php					
          }
        }
        
        foreach ($colIndexes as $c => $j) 
        {
          $dataRow = isset($indexToData[$i][$j]) ? 
              $indexToData[$i][$j] : array();
          foreach($dataFields as $df)
          {
            ?>
              <td class='pivot-data-cell' 
                  data-row-index=<?=$r;?>
                  data-column-index=<?=$c;?>
                  data-layer=1>
                <?php 
                  echo isset($dataRow[$df]) ? 
                    $dataRow[$df] : $emptyValue; ?>
              </td>
            <?php					
          }
        }
        ?>
      </tr>
      <?php	
		}
		?>
	</tbody>
</table>
<script type='text/javascript'>
  var rowCollapseLevels = <?php echo json_encode($rowCollapseLevels); ?>;
  rowCollapseLevels.sort(function(a,b){ return b-a;});
  var colCollapseLevels = <?php echo json_encode($colCollapseLevels); ?>;
  colCollapseLevels.sort(function(a,b){ return b-a;});
  var <?=$uniqueId?> = {
    id: "<?=$uniqueId?>",
    rowCollapseLevels: rowCollapseLevels,
    colCollapseLevels: colCollapseLevels,
    numRowFields: <?php echo count($rowFields); ?>,
    numColFields: <?php echo count($colFields); ?>,
    numDataFields: <?php echo count($dataFields); ?>,
  }
  initPivot(<?=$uniqueId?>);
</script>
