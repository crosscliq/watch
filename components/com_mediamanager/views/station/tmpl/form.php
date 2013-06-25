<?php 
$row = $this->row;

$doc = JFactory::getDocument();
$doc->addStyleSheet('http://twitter.github.io/bootstrap/assets/css/bootstrap.css');


?>



<form class="form-vertical" action="index.php?option=com_mediamanager&view=station&task=save" method="POST">
<fieldset>
<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">MAC ADDRESS</span>
      <input id="" name="station_notes" class="input-large" disabled='disabled' value="<?php echo $this->uuid; ?>" type="text">
    </div>
  </div>
</div>

<input id="" name="uuid" type="hidden" value="<?php echo @$this->uuid; ?>">
<input id="" name="station_id" type="hidden" value="<?php echo @$row->station_id; ?>">
<!-- Form Name -->
<div class="well"> 
<legend style="margin-bottom:0px;">Required Information</legend>
<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">NAME</span>
      <input id="" name="station_name" class="input-large" value="<?php echo @$row->station_name; ?>" type="text">
    </div>
  </div>
</div>

<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">Street Address</span>
      <input id="" name="station_address1" class="input-large" value="<?php echo @$row->station_address1; ?>"type="text">
    </div>
  </div>
</div>

<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">Street Address2</span>
      <input id="" name="station_address2" class="input-large" value="<?php echo @$row->station_address2; ?>" type="text">
    </div>
  </div>
</div>

<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">Provence</span>

      <select id="selectbasic" name="station_provence" value="<?php echo @$row->station_provence; ?>" class="input-xlarge">
      <option>Ontario</option>
      <option>Québec</option>
      <option>British Columbia</option>
      <option>Alberta</option>
      <option>Nova Scotia</option>
      <option>Manitoba</option>
      <option>Saskatchewan</option>
      <option>New Brunswick</option>
      <option>Prince Edward Island</option>
      <option>Newfoundland and Labrador</option>
    </select>
     
    </div>
  </div>
</div>

<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">City</span>
      <input id="" name="station_city" class="input-large" value="<?php echo @$row->station_city; ?>" type="text">
    </div>
  </div>
</div>

<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">Postal Code</span>
      <input id="" name="station_postalcode" class="input-large" value="<?php echo @$row->station_postalcode; ?>" type="text">
    </div>
  </div>
</div>

<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">Country</span>
      <input id="" name="station_country" class="input-large" value="Canada" value="<?php echo @$row->station_country; ?>" type="text">
    </div>
  </div>
</div>

<input type="submit" class="btn btn-large">
</div>
<div class="well-small well">
<legend style="margin-bottom:0px;" >Extra Information</legend>
<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">Description</span>
      <input id="" name="station_desc" class="input-large" placeholder=" " type="text">
    </div>
  </div>
</div>

<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">Notes</span>
      <input id="" name="station_notes" class="input-large" placeholder=" " type="text">
    </div>
  </div>
</div>



<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">Latitude</span>
      <input id="" name="station_lat" class="input-large" placeholder=" " type="text">
    </div>
  </div>
</div>

<!-- Prepended text-->
<div class="control-group">
  <label class="control-label" for=""></label>
  <div class="controls">
    <div class="input-prepend">
      <span class="add-on">Longitude</span>
      <input id="" name="station_lng" class="input-large" placeholder=" " type="text">
    </div>
  </div>
</div>


<input type="submit" class="btn btn-large">
</div>
</fieldset>
</form>
