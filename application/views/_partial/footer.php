<footer class="main-footer">
    <?php if($this->session->userdata('role') != 1 || $this->session->userdata('role') != 2) {
        ?>
        <div class="container">
    <?php } ?>
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y');?></strong>
    <?php if($this->session->userdata('role') != 1 || $this->session->userdata('role') != 2) {
        ?>
        </div>
    <?php } ?>
</footer>
</div>
</body>
</html>