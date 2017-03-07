<?php
namespace ChartJS\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * ChartJS helper
 * Read more about ChartJS at http://www.chartjs.org/docs/
 */
class ChartJSHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public $helpers = ['Html'];

    protected $id = 'chartjs';
    
    protected $chartCount = 0;
    
    protected $canvasOptions = [
        'id' => 'chartjs',
        'width' => '200',
        'height' => '200',
        'style' => ['max-height' => '500px'],
    ];
    
    protected $js = [];
    protected $data = [
        'datasets' => [],
        'labels' => []
    ];
    protected $options = [];
   
    public function start($id){
        $this->chartCount++;
        $this->id = $id;
        $this->setCanvasOptions(['id' => $this->id, 'width' => 400, 'height' => 400, 'class' => 'chartjs'], true);
        $this->js = [];
        $this->data = [
            'datasets' => [],
            'labels' => []
        ];
        $this->options = [];
    }
    
    public function setCanvasOptions($options = [], $clear = false){
        $this->canvasOptions = $clear ?
            $options :
            array_merge($this->canvasOptions, $options);
    }
    
    protected function render($options = []){
        if ($this->chartCount < 2){
            $this->_View->prepend('script', $this->Html->script('//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.min.js', ['once' => true]));
        }
        echo $this->Html->tag('canvas', '', $this->canvasOptions);

        $this->options = array_merge($this->options, $options);
        $id = $this->id;
        $jsStart = [];
        $jsStart[] = "var data$id = ".json_encode($this->data).";";
        $jsStart[] = "var options$id = ".json_encode($this->options).";";
        $jsStart[] = "var ctx$id = \"$id\";";
        
        $this->Html->scriptBlock(implode("\n", array_merge($jsStart, $this->js)), ['block' => true, 'type' => "text/javascript"]);
    }

    public function addLabels($labels, $options = []){
        $this->data['labels'] = $labels;
    }
    
    public function addDataset($serie, $label = '', $options = []){
        $dataset['data'] = $serie;
        $dataset['label'] = $label;
        array_push($this->data['datasets'], array_merge($dataset, $options));
    }
    
    public function lineChart($options = []){
        $id = $this->id;
        $this->js[] = "var lineChart$id = new Chart(";
        $this->js[] = "ctx$id,";
        $this->js[] = '{';
        $this->js[] = "type: 'line',";
        $this->js[] = "data: data$id,";
        $this->js[] = "options: options$id,";
        $this->js[] = '});';
        $this->render($options);
    }

    public function barChart($options = []){
        $id = $this->id;
        $this->js[] = "var barChart$id = new Chart(";
        $this->js[] = "ctx$id,";
        $this->js[] = '{';
        $this->js[] = "type: 'bar',";
        $this->js[] = "data: data$id,";
        $this->js[] = "options: options$id,";
        $this->js[] = '});';
        $this->render($options);
    }
}
