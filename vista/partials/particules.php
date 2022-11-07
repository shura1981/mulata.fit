<script src="<?php echo URL_VISTA?>js/particles/particles.min.js"></script>
<script src="<?php echo URL_VISTA?>js/particles/app.js"></script>
<script>
window.onload = function() {
    let clause = window.innerWidth < 768;
    const link =
        <?= json_encode(URL_VISTA,JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_NUMERIC_CHECK) ?>;
    const url = `${link}js/particles/option3.json`;
    fetch(url)
        .then(resp => resp.json())
        .then(config2 => {
            config2.particles.number.value = clause ? 30 : 50;
            particlesJS('particles-js', config2);
            particlesJS('particles2-js', config2);
            particlesJS('particles3-js', config2);
        }).catch(e => console.log(e));

}
</script>