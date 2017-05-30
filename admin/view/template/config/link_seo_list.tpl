<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-link-seo').submit() : false;"><i class="fa fa-trash-o"></i></button>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
      </div>
      <div class="panel-body">
        <div class="well">
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label class="control-label" for="input-query"><?php echo $entry_query; ?></label>
                <input type="text" name="filter_query" value="<?php echo $filter_query; ?>" placeholder="<?php echo $entry_query; ?>" id="input-query" class="form-control" />
              </div>
              <div class="form-group">
                <label class="control-label" for="input-keyword"><?php echo $entry_keyword; ?></label>
                <input type="text" name="filter_keyword" value="<?php echo $filter_keyword; ?>" placeholder="<?php echo $entry_keyword; ?>" id="input-keyword" class="form-control" />
              </div>
            </div>
            <div class="col-sm-4">
              <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
            </div>
          </div>
        </div>
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-link-seo">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-left"><?php echo $column_query?></td>
                  <td class="text-left"><?php echo $column_keyword; ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($link_seo) { ?>
                <?php foreach ($link_seo as $seo) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($seo['url_alias_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $seo['url_alias_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $seo['url_alias_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-left"><?php echo $seo['query']; ?></td>
                  <td class="text-left"><?php echo $seo['keyword']; ?></td>
                  <td class="text-right"><a href="<?php echo $seo['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a></td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="3"><?php echo $text_no_results; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </form>
        <div class="row">
          <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
          <div class="col-sm-6 text-right"><?php echo $results; ?></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$('#button-filter').on('click', function() {
	var url = 'index.php?route=config/seo&token=<?php echo $token; ?>';

	var filter_query = $('input[name=\'filter_query\']').val();

	if (filter_query) {
		url += '&filter_query=' + encodeURIComponent(filter_query);
	}

	var filter_keyword = $('input[name=\'filter_keyword\']').val();

	if (filter_keyword) {
		url += '&filter_keyword=' + encodeURIComponent(filter_keyword);
	}

	var filter_price = $('input[name=\'filter_price\']').val();

	if (filter_price) {
		url += '&filter_price=' + encodeURIComponent(filter_price);
	}

	var filter_quantity = $('input[name=\'filter_quantity\']').val();

	if (filter_quantity) {
		url += '&filter_quantity=' + encodeURIComponent(filter_quantity);
	}

	var filter_status = $('select[name=\'filter_status\']').val();

	if (filter_status != '*') {
		url += '&filter_status=' + encodeURIComponent(filter_status);
	}

	location = url;
});
</script>
  <script type="text/javascript">
$('input[name=\'filter_query\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=config/link_seo/autocomplete&token=<?php echo $token; ?>&filter_query=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['query'],
						value: item['url_alias_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_query\']').val(item['label']);
	}
});

$('input[name=\'filter_keyword\']').autocomplete({
	'source': function(request, response) {
		$.ajax({
			url: 'index.php?route=config/link_seo/autocomplete&token=<?php echo $token; ?>&filter_keyword=' +  encodeURIComponent(request),
			dataType: 'json',
			success: function(json) {
				response($.map(json, function(item) {
					return {
						label: item['keyword'],
						value: item['url_alias_id']
					}
				}));
			}
		});
	},
	'select': function(item) {
		$('input[name=\'filter_keyword\']').val(item['label']);
	}
});
</script>

<?php echo $footer; ?>