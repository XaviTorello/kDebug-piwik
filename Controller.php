<?php
/**
 * Piwik - Open source web analytics
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 * Xavi Torello - http://xaviertorello.cat
 *
 */
namespace Piwik\Plugins\KDebug;

use KDebug;
use Piwik\Piwik;
use Piwik\View;

class Controller extends \Piwik\Plugin\ControllerAdmin
{
    function index()
    {
        Piwik::checkUserHasSuperUserAccess();

        require_once(dirname(__FILE__) . '/KDebug/KDebug.php');

        $kdg = new KDebug();

        $kdg->loadAndRun();

        $results = $kdg->getResultsAsArray();

        $view = new View('@KDebug/index');
        $this->setBasicVariablesView($view);
        $view->results = $results;
        return $view->render();
    }
}
