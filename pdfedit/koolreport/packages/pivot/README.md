# Introduction

A pivot table is a data summerization tool necessary in pretty much any data anylytical program. It can count, total or average data based on multi dimensional groups to provide insight from raw data. Basically, a pivot table has two parts, one is multi-dimensional labels or headers, the other is aggregated or summerized data for such labels. Here is an example:

<img />

The above example is a two dimensional (column and row) pivot table which is visualized by the columns' and rows' label/header and the summerized data (total sum in this case) of them. Each dimension can consist of multiple fields (Year and Month in column, Customer and Product in row) so you could drill down (like expanding) or roll up (like collapsing) the labels and their summerized data.

# Installation

1. Download and unzip the zipped file.
2. Copy the folder `pivot` into `koolreport/packages` folder

# Usage

Our Pivot package contains a Pivot process for setting up a pivot table's structure and a PivotTable widget to visualize it:

```
<?php
use \koolreport\pivot\processes\Pivot;

class CustomersCategoriesProducts extends koolreport\KoolReport
{
  function setup()
  {
    $node = $this->src('sales')
    ->query("SELECT customerName, productLine, orderYear, orderMonth, dollar_sales
      FROM customer_product_dollarsales");
    ->pipe(new Pivot(array(
      "dimensions" => array(
        "column" => "orderYear, orderMonth",
        "row" => "customerName, productLine"
      ),
      "aggregates"=>array(
        "sum" => "dollar_sales",
        "count" => "dollar_sales"
      )
    )))
    ->pipe($this->dataStore('salesReport'));  
  }
}
```

To set up a Pivot process, you would have to specify at least one dimension of label fields and a list of data fields (e.g dollar_sales) with aggregation methods (sum, count or average). In theory, a pivot could have multiple dimensions. In practice, users often set up one or two dimensions for easier viewing. The pivot process would aggregate data and save the result to a datastore.
Then in the report view, you can use the PivotTable widget to visualize the labels and the summerized data in the datastore:

```
<?php
use \koolreport\pivot\widgets\PivotTable;
PivotTable::create(array(
  "dataStore"=>$this->dataStore('salesReport')
));
```

For the simplest configuration you only need to tell which pivot datastore to be displayed, the widget would use a default setup to show it. Of course for finer tuning the widget has detailed options for you to customize.

# Documentation

## Dimensions

Even though a pivot process can handle more than two dimension, when viewing a pivot table widget can only show at most two dimensions at once. By default, the two dimensions to be display are "row" and "column" but you could change them according to your setup:

```
<?php
class CustomersCategoriesProducts extends koolreport\KoolReport
{
  function setup()
  {
    ...
    ->pipe(new Pivot(array(
      "dimensions" => array(
        "dimen1" => "orderYear, orderMonth",
        "dimen2" => "customerName, productLine"
      ),
      ...
    )))
    ...
  }
}
```

```
<?php
PivotTable::create(array(
  "dataStore"=>$this->dataStore('salesReport'),
  'rowDimension'=>'dimen1',
  'columnDimension'=>'dimen2',
));
```

## Measures

By default, a pivot table widget will show all summerized data available in a datastore. If you only want to show some of them, specify those in the measures property:


```
<?php
class CustomersCategoriesProducts extends koolreport\KoolReport
{
  function setup()
  {
    ...
    ->pipe(new Pivot(array(
      ...
      "aggregates"=>array(
        "sum" => "dollar_sales",
        "count" => "dollar_sales",
      )
    )))
    ...
  }
}
```

```
<?php
PivotTable::create(array(
  "dataStore"=>$this->dataStore('salesReport'),
  'measures'=>array(
    'dollar_sales - count'
  ),
));
```

## Sort

A pivot table could be sorted simultaneously in each of its dimension (e.g column and row). In each dimensional sort, you could specify either label fields or a summerized data field. Sorting order is either ascending, descending or a custom function comparing two values.

```
<?php
PivotTable::create(array(
  ...
  'rowSort' => array(
    'orderMonth' => function($a, $b) {
      return (int)$a < (int)$b;
    }, 
    'orderDay' => 'asc'
  ),
  'columnSort' => array(
    'dollar_sales - sum' => 'desc',
    'orderYear' => function($a, $b) {
      return (int)$a < (int)$b;
    }, 
  ),
  ...
));
```

## Map

Mapping allows you an option to change displaying the data in datastore. There are header map for headers/labels and data map for summerized data. The map could be either an array or a custom function with a value and its belonging field arguments.

```
<?php
PivotTable::create(array(
  ...
  'headerMap' => array(
    'dollar_sales - sum' => 'Sales (in USD)',
    'dollar_sales - count' => 'Number of Sales',
  ),
  'headerMap' => function($v, $f) {
    if ($v === 'dollar_sales - sum')
      $v = 'Sales (in USD)';
    if ($v === 'dollar_sales - count')
      $v = 'Number of Sales';
    if ($f === 'orderYear')
      $v = 'Year ' . $v;
    return $v;
  },
  'dataMap' => function($v, $f) {return $v;},
  ...
));
```

## Appearance

### Collapse level

If you have a large pivot table and don't want it to fully expand at initial loading you could set up its initial collapse levels for each dimension.

```
<?php
PivotTable::create(array(
  ...
  'rowCollapseLevels' => array(0),
  'columnCollapseLevels' => array(0, 1, 2),
  ...
));
```

### Total name

This property helps you change the label of the "total" rows and columns. By default it's "Total".

```
<?php
PivotTable::create(array(
  ...
  'totalName' => 'All',
  ...
));
```

### Hide total column/row

These properties allows you to hide the Grand Total column/row:

```
<?php
PivotTable::create(array(
  ...
  'hideTotalRow' => true,
  'hideTotalColumn' => true,
  ...
));
```

### Width

This property let us defined the width css of the pivot table widtget.

```
<?php
PivotTable::create(array(
  ...
    'width' => '100%',
  ...
));
```
