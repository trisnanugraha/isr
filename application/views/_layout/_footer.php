<?php
$apl = $this->db->get("aplikasi")->row();
?>
<footer class="main-footer navbar-default">
    <strong>Copyright &copy; <?php echo $apl->tahun; ?> <a href="#"><?php echo $apl->nama_owner; ?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> <?php echo $apl->versi; ?>
    </div>
</footer>