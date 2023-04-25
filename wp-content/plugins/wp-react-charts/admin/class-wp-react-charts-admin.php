<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://amit-chawla.com
 * @since      1.0.0
 *
 * @package    Wp_React_Charts
 * @subpackage Wp_React_Charts/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_React_Charts
 * @subpackage Wp_React_Charts/admin
 * @author     Amit Chawla <amit.chawla.mca@live.com>
 */
class Wp_React_Charts_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->api_namespace = "chart/v";
		$this->base = "data";
		$this->api_version = "1";

		add_action('wp_dashboard_setup',array($this,'react_chart_dashboard_widget'));
		add_action('rest_api_init',array($this, 'api_register'));


	}
	public function react_chart_dashboard_widget(){
		wp_add_dashboard_widget(
			'react_chart_dashboard_widget',
			'Graph Widget',
			array($this,'react_chart_dashboard_widget_callback')			
		);
	}

	public function react_chart_dashboard_widget_callback(){
		
		$widgetDesign = '<div class="widget-card" id="chart-graph"> </div>'; 
			
		echo $widgetDesign;
			?>
			
	<script crossorigin src="https://unpkg.com/react@16/umd/react.development.js"></script>
    <script crossorigin src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
    <script src="https://unpkg.com/babel-standalone@6/babel.min.js"></script>       	
	<script crossorigin src="https://unpkg.com/prop-types/prop-types.min.js"></script>
	<script src="https://unpkg.com/recharts/umd/Recharts.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.6/axios.min.js"></script>
    <script type="text/jsx">
		const {useState} = React;
		const {AreaChart,XAxis,YAxis,CartesianGrid,Tooltip,Area }= Recharts;
	
		
		const WPChart = () => {
			const [data, setData] = useState([{name: 'Page A', uv: 400, pv: 2400, amt: 2400}]);
		
			React.useEffect(() => {
				axios.get("http://localhost/wp-react-chart-demo/wp-json/chart/v1/data").then((response) => {
				setData(response.data);
				});
			}, []);
		const find = async(option:string)=>{
			let response = await axios.get(`http://localhost/wp-react-chart-demo/wp-json/chart/v1/data?days=${option}`)
			setData(response.data);
			
		}
		return (
			<div>
			<div className="widget-card-header">
					<span>Sales Report</span>
					<select onChange={(e) => find(e.target.value)} style={{float: "right"}}>
						<option value="7">Last 7 days</option>
						<option value="15">Last 15 days</option>
						<option value="30">1 Month</option>
					</select>
					
				</div>
				<div className="widget-card-body">
			<AreaChart width={430} height={250} data={data} margin={{ top: 10, right: 30, left: 0, bottom: 0 }}>
			<defs>
				<linearGradient id="colorUv" x1="0" y1="0" x2="0" y2="1">
				<stop offset="5%" stopColor="#8884d8" stopOpacity={0.8}/>
				<stop offset="95%" stopColor="#8884d8" stopOpacity={0}/>
				</linearGradient>
				<linearGradient id="colorPv" x1="0" y1="0" x2="0" y2="1">
				<stop offset="5%" stopColor="#82ca9d" stopOpacity={0.8}/>
				<stop offset="95%" stopColor="#82ca9d" stopOpacity={0}/>
				</linearGradient>
			</defs>
			<XAxis dataKey="name" />
			<YAxis domain={[200, 1800]}/>
			<CartesianGrid strokeDasharray="3 3" />
			<Tooltip />
			<Area type="monotone" dataKey="uv" stroke="#8884d8" fillOpacity={1} fill="url(#colorUv)" />
			<Area type="monotone" dataKey="pv" stroke="#82ca9d" fillOpacity={1} fill="url(#colorPv)" />
			</AreaChart>
			</div>
		</div>
		);
		};

        ReactDOM.render(<WPChart  />, document.getElementById("chart-graph"));
    </script>

			
	<?php
	}

	public function api_register(){
		$namespace = $this->api_namespace.$this->api_version;

		register_rest_route($namespace, '/'.$this->base, array(
			array(
				'methods' => WP_REST_Server::ALLMETHODS,
				'callback' => array($this,'chart_data')
			)
		));
	}

	public function chart_data(){
		global $wpdb;
		$endDate = date('Y-m-d');
		if(isset($_GET['days'])){
			if($_GET['days']==15){
				$startDate =  date('Y-m-d',strtotime('-14 days'));
			}
			else if($_GET['days']==30){
				$startDate =  date('Y-m-d',strtotime('-30 days'));		
			}
			else{
				$startDate =  date('Y-m-d',strtotime('-6 days'));			
			}
		}
		else{
			$startDate =  date('Y-m-d',strtotime('-6 days'));			
		}
		$data = $wpdb->get_results("SELECT * FROM `wp_chart_data` where (sale_date BETWEEN '".$startDate."' and '".$endDate."')");

		return rest_ensure_response(array_values($data));
	}


	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_React_Charts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_React_Charts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-react-charts-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_React_Charts_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_React_Charts_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-react-charts-admin.js', array( 'jquery' ), $this->version, false );

	}

}
