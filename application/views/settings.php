<?php $this->load->view('components/page_head'); ?>
<body class="off-canvas hide-extras">

<?php $this->load->view('includes/header');?>
<?php $this->load->view('navigation');?>
<div class="container">
<?php $this->load->view('edit_user');?>
</div>	

<?php $this->load->view('includes/footer');?>
<?php $this->load->view('components/page_tail');?>