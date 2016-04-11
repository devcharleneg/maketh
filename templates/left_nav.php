<?php 
$i = 1;
$categories = array(
  'Men' => [
      'Top' => [
          'T-Shirts',
          'Polo',
          'Longsleeves'
      ],
      'Bottom' => [
          'Short',
          'Pants'
      ],
      'Bag' => [
          'Backpack',
          'Wallet',
          'Sling Bag',
          'Shoulder Bag',
      ]
  ],
  'Women' => [
      'Top' => [
          'T-Shirts',
          'Polo',
          'Longsleeves'
      ],
      'Bottom' => [
          'Short',
          'Pants'
      ],
      'Bag' => [
          'Backpack',
          'Sling Bag',
          'Shoulder Bag',
          'Wallet'
      ]
  ]
);
if(isset($_SESSION['username']))
{
    $url = '/maketh/shop/customer/list.php';
}
else
{
    $url = '/maketh/shop/list.php';
}
?>
<div class="col-sm-3">
          <div class="row">
                  <div class="col-sm-12">
                    <?php foreach ($categories as $gender => $category): ?>
                      <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><a href="<?= $url ?>?sex=<?= $gender ?>"><?= $gender; ?></a></h3>
                        </div>   
                        <?php foreach ($categories[$gender] as $category => $subcategory): ?>
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="row toggle" id="dropdown-detail-<?= $i ?>" data-toggle="detail-<?= $i ?>">
                                        <div class="col-xs-10">
                                            <a href="<?= $url ?>?cat=<?= $category ?>&sex=<?= $gender ?>"><?= $category; ?></a>
                                        </div>
                                        <div class="col-xs-2"><i class="fa fa-chevron-down pull-right"id="arrow-<?= $i ?>"></i></div>
                                    </div>
                                    <div id="detail-<?= $i ?>">
                                            <div class="row">
                                                  <div class="col-sm-12">
                                                    <ul class="list-group">
                                                      <?php foreach ($categories[$gender][$category] as $category => $subcategory): ?>
                                                          <a href="<?= $url ?>?subcat=<?= $subcategory ?>&sex=<?= $gender ?>"><li class="list-group-item"><?= $subcategory ?></li></a>
                                                      <?php endforeach ?><!-- loopsub category -->
                                                      </ul>
                                                  </div>
                                            </div>
                                    </div>
                                </li>
                            </ul>
                            <?php  $i += 1; ?>
                        <?php endforeach ?>  <!--loop  category --> 
                      </div>
                    <?php endforeach ?><!-- loop gender -->
                  </div><!-- left categories -->
          </div><!-- row categories -->
</div><!-- column categories -->