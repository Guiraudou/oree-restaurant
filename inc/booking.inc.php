<script>
	;(function (d, s, id) {
		const el = d.getElementsByTagName(s)[0]
		if (d.getElementById(id) || el.parentNode == null) return
		var js = d.createElement(s)
		js.id = id
		js.src = 'https://sdk.zenchef.com/v1/sdk.min.js'
		el.parentNode.insertBefore(js, el)
	})(document, 'script', 'zenchef-sdk')
</script>
<div class="zc-widget-config"
	data-restaurant="388055"
	data-open="2000"
	data-primary-color="34411e"
	data-lang="fr"></div>
<button data-zc-action="open">Open widget</button>
<button data-zc-action="close">Close widget</button>
