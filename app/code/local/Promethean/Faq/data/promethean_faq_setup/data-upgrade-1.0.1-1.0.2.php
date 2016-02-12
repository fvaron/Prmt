<?php
/**
 * This file is part of Promethean_Faq for Magento.
 *
 * @license All rights reserved
 * @author Caroline Framery <framery.caroline@laposte.net> <t>
 * @category Promethean
 * @package Promethean_Faq
 * @copyright Copyright (c) 2016 Caroline Framery (http://)
 */

try {

    $cat = Mage::getModel('faq/cat')->setData(array('name' => 'Questions', 'is_active' => 1, 'stores' => 0))->save();

    $q1 = <<<HTML
<p>Promethean est leader français et numéro 2 mondial des tableaux interactifs et autres solutions d’apprentissage interactives. Ainsi, depuis des années l'entreprise britannique a fait ses preuves et conquis de plus en plus d'établissements français.</p>
<p>La plus-value de Promethean réside dans la grande qualité de ses produits, dont la durée de vie et les performances sont incomparables. De plus, toutes les solutions Promethean n’utilisent qu’un seul logiciel très complet et intuitif. Ce logiciel nommé ActivInspire est le plus riche des logiciels de gestion de contenus pédagogiques et a été primé à de nombreuses reprises. Son interface simplifiée ainsi que son très grand nombre de fonctionnalités rendent son utilisation accessible à tous et aussi intuitive que des logiciels comme Paint ou PowerPoint. ActivInspire a été initialement conçu pour une utilisation dans les classes du primaire et du secondaire, et plutôt pour créer des leçons interactives. Cependant, il convient aussi totalement à des fonctions plus corporate, et s’adresse tout à fait aux besoins des entreprises : réalisation de présentations interactives, animation de réunions, partage de ressources, création de contenu etc.</p>
<p>Pour ce qui est des matériels Promethean, ils se démarquent de leurs concurrents de par leur robustesse, leurs performance et là encore leur utilisation intuitive. Chez Promethean, tous les produits ont été pensés pour être accessibles à tous et correspondre à une utilisation abondante et régulière.</p>
<p>Enfin, l’entreprise doit également son succès à l’ensemble des services qui accompagnent ces solutions de pointe. En effet, les utilisateurs Promethean bénéficient d’une assistance téléphonique, d’une bibliothèque géante de ressources et supports pédagogiques avec Promethean Planet, d’un SAV ultra complet et performant, d’une aide au choix sous forme de supports visuels et de guides d’achat, de démonstrations gratuites, de conseils personnalisés etc. De plus, grâce au réseau de revendeurs agréés Promethean, chaque client est assuré d’être accompagné de près par une équipe de spécialistes confirmés en solutions Promethean.</p>
<p>En effet, les revendeurs Promethean sont triés sur le volet et ne peuvent exercer qu’après l’obtention d’un agrément délivré par l’entreprise Promethean. ProInteractive fait partie de ces revendeurs agréés qui travaillent sans relâche pour que votre expérience Promethean soit la plus satisfaisante, pérenne et fructueuse possible.</p>
HTML;

    $q2 = <<<HTML
<p>Pour les entreprises, il est tout à fait possible d’utiliser des produits pour l’Education, simplement car il n’y a pas de matériels spécifiques pour l’Education ou d’autres pour les entreprises. Seuls les logiciels Education et Entreprises sont distincts : ActivInspire pour l’Education et ActivOffice le complément pour les entreprises.</p>
HTML;

    $q3 = <<<HTML
<p>Gamme Activboard Touch : Optimisée pour le tactile est très responsive, zoom actif la gamme peut être ajustable en hauteur et s’adapter à la taille des enseignants ou des étudiants/enfants.</p>
<p>Gamme ActivPanel Touch : Pas de reflets, qualité unique des images, pas de vidéoprojecteur.</p>
HTML;

    $q4 = <<<HTML
<p><a href="http://www1.prometheanplanet.com/fr/upload/pdf/ActivInspire_ProfessionalV.1.8_EULA_FINAL_FR.pdf"><strong>http://www1.prometheanplanet.com/fr/upload/pdf/ActivInspire_ProfessionalV.1.8_EULA_FINAL_FR.pdf</strong></a></p>
HTML;

    $q5 = <<<HTML
<p>Tutoriel logiciel Activinspire : <a href="http://www.preaohg.fr/wp-content/uploads/2010/02/tutoriel_activinspire.pdf">http://www.preaohg.fr/wp-content/uploads/2010/02/tutoriel_activinspire.pdf</a><br> - Se rendre sur le site Promethean Planet et télécharger ActivInspire</p>
HTML;

    $q6 = <<<HTML
<p>Il existe une licence gratuite avec une version d’essai de 90 jours.<br />
Le logiciel deviendra payant à l’issue de cette période.</p>
HTML;

    $q7 = <<<HTML
<p>Le logiciel ActivInspire peut être installé sur un matériel d’une autre marque, et un autre logiciel peut être utilisé sur un ActivBoard Promethean par exemple.</p>
HTML;

    $q8 = <<<HTML
<p>L’ActivGlide est le nom donné pour la technologie de surface, au stylet ou au doigt tactile ; L’ActivGlide garantit la haute précision de votre écriture ou de votre toucher. Elle empêche également les sensations de brulures pouvant survenir au bout des doigts après une utilisation longue durée. L’ActivGlide est la technologie utilisée par l’écran de l’ActivPanel.</p>
HTML;

    $q9 = <<<HTML
<p>Les ActivBoard et ActivPanel Promethean sont dotés de nombreuses entrées audio, vous permettant ainsi de connecter notamment un micro ou des haut-parleurs. De plus, toutes (sauf l’ActivBoard TOUCH), disposent d’enceintes intégrées. Il vous suffira ensuite simplement de vous connecter à un logiciel de visioconférence, tels que Webex ou Skype, pour converser à distance.</p>
HTML;

    $q10 = <<<HTML
<p>Promethean Applications apporte à votre <a href="{{store url="activboard.html"}}">ActivBoard 500 PRO</a> de nouvelles fonctionnalités à travers 2 applications utiles.</p>
<p>Les avantages de Promethean Applications :</p>
<ul>
<li>1 installation pour obtenir 2 applications pratiques: NoteBoard et TouchPad</li>
<li>Compatible et offert avec l’<a href="{{store url="activboard.html"}}">Activboard 500 PRO</a></li>
<li>L’outil très precise de reconnaissance d’écriture</li>
<li>Pen and touch capability extends learning and collaboration opportunities</li>
<li>L’application NoteBoard développe particulièrement le brainstorming en motivant et mettant en competition les élèves / l’audience</li>
<li>TouchPad permet de créer des notes sous forme d’images, que l’on peut ensuite partager</li>
</ul>
HTML;

    $questions = array(
        array(
            'cat_id' => $cat->getId(),
            'sort' => 0,
            'question' => "Quels sont les atouts des produits Promethean ?",
            'response' => $q1,
            'is_active' => 1,
            'is_most_frequently_asked' => 1
        ),
        array(
            'cat_id' => $cat->getId(),
            'sort' => 1,
            'question' => "Si je suis une entreprise, puis-je acheter des produits pour l’Education ?",
            'response' => $q2,
            'is_active' => 1,
            'is_most_frequently_asked' => 1
        ),
        array(
            'cat_id' => $cat->getId(),
            'sort' => 2,
            'question' => "Comment reconnaitre les gammes Promethean ?",
            'response' => $q3,
            'is_active' => 1,
            'is_most_frequently_asked' => 1
        ),
        array(
            'cat_id' => $cat->getId(),
            'sort' => 3,
            'question' => "Comment fonctionnent les licences logicielles de Promethean ?",
            'response' => $q4,
            'is_active' => 1,
            'is_most_frequently_asked' => 1
        ),
        array(
            'cat_id' => $cat->getId(),
            'sort' => 4,
            'question' => "Comment activer le logiciel avec une licence ActivInspire ?",
            'response' => $q5,
            'is_active' => 1,
            'is_most_frequently_asked' => 1
        ),
        array(
            'cat_id' => $cat->getId(),
            'sort' => 5,
            'question' => "Existe-t-il des licences gratuites Promethean ?",
            'response' => $q6,
            'is_active' => 1,
            'is_most_frequently_asked' => 1
        ),
        array(
            'cat_id' => $cat->getId(),
            'sort' => 6,
            'question' => "Peut-on utiliser un logiciel Promethean avec des produits d’autres marques ?",
            'response' => $q7,
            'is_active' => 1,
            'is_most_frequently_asked' => 1
        ),
        array(
            'cat_id' => $cat->getId(),
            'sort' => 7,
            'question' => "Qu’est-ce que ActivGlide ?",
            'response' => $q8,
            'is_active' => 1,
            'is_most_frequently_asked' => 1
        ),
        array(
            'cat_id' => $cat->getId(),
            'sort' => 8,
            'question' => "Comment et sur quels solutions Promethean peut-on réaliser des visioconférences ?",
            'response' => $q9,
            'is_active' => 1,
            'is_most_frequently_asked' => 1
        ),
        array(
            'cat_id' => $cat->getId(),
            'sort' => 9,
            'question' => "Qu'est-ce que Promethean Applications?",
            'response' => $q10,
            'is_active' => 1,
            'is_most_frequently_asked' => 1
        )
    );

    foreach($questions as $question) {
        Mage::getModel('faq/faq')->setData($question)->save();
    }

} catch (Exception $e) {
    Mage::logException($e);
}
