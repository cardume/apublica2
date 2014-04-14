<div class="comment-area">
<h2><?php _e('Comentários', 'Divi') ?></h2>
<p> <?php _e('Opte por Disqus ou Facebook', 'Divi') ?></p>
	<div class="et_pb_row">
		<div class="et_pb_column et_pb_column_1_2">
			 <div id="disqus_thread"></div>
			    <script type="text/javascript">
			        
			        var disqus_shortname = 'publicatest'; 
			        var disqus_url = '{{ site.url }}{{ page.url }}';

			        /* * * DON'T EDIT BELOW THIS LINE * * */
			        (function() {
			            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
			            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
			            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
			        })();
			    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
    
		</div>
		<div class="et_pb_column et_pb_column_1_2">
			<div class="fb-comments" data-href="http://example.com/comments" data-width="510" data-numposts="5" data-colorscheme="light"></div>
		</div>
	</div>
</div>