<?php  
get_header();
?>
<section class="section-basic course-opening">
	<div class="uncontained-bg" aria-hidden="true" 
	style="background-image: url('<?= get_the_post_thumbnail_url('', 'course-background'); ?>')"></div>
	<div class="center-content inner">
		<div class="limited">
			<h1 class="section-title regular-title text-white margin">
				Aulas de Música em
				<span class="text-bigger">
					Domicílio
				</span>
			</h1>
			<p class="text-regular text-white hiline smaller-margin">
				<?php strip_tags( the_content() ); ?>
			</p>
			<button class="btn-transparent schedule-now">
				AGENDE AGORA!
			</button>
		</div>
	</div>
</section>
<section class="section-basic course-info">
	<div class="center-content inner flexed default">
		<div class="info-container">	
			<h2 class="section-title smaller-title text-white margin">
				Metodologia de 
				<span class="text-bigger">
					<strong>Qualidade</strong>
				</span>
			</h2>
			<p class="text-regular text-white hiline smaller-margin">
				Todos os professores da Roll Music são cuidadosamente selecionados, levando em consideração sua experiência e sua formação acadêmica. Em uma didática moderna e eficiente, as aulas unem teoria e prática de modo agradável, tornando o processo de aprendizagem leve e prático.
			</p>
			<p class="text-regular text-white hiline">
				As aulas são personalizadas de acordo com o objetivo do aluno, e oferecemos material didático exclusivo. Com a Escola Infinity, seja para tocar ou cantar, você explora seus potenciais e desenvolve seus talentos musicais.
			</p>
		</div>
		<?php get_template_part('includes/components/we-call-widget'); ?>
	</div>
</section>
<?php 
get_template_part('includes/components/random-courses');
get_template_part('includes/sections/schedule-class');
get_template_part('includes/sections/blog-feed');
get_template_part('includes/sections/contact'); 
?>