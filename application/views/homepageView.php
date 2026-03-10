<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Suropriyo Enterprise</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

	<link rel="stylesheet" href="<?= base_url(); ?>css/Home.css">
	<style>
		body {
			margin: 0;
			/* overflow: hidden;  */

			background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(6, 5, 82, 1) 7%, rgba(9, 9, 121, 1) 21%, rgba(4, 130, 201, 1) 56%, rgba(0, 212, 255, 1) 89%) !important;
			color: #ffffff !important;
			font-family: 'Arial', sans-serif;
		}

		canvas {
			display: block;
			position: absolute;
			top: 0;
			left: 0;
			z-index: 0;
		}

		.hero-section {
			position: relative;
			height: 100vh;
			min-height: 750px;
			padding-top: 80px;
			display: flex;
			align-items: center;
			overflow: hidden;
		}

		/* HERO CONTENT */
		.hero-content {
			position: relative;
			z-index: 10;
			color: white;
			padding: 0 20px;
		}

		.hero-section h1 {
			font-size: clamp(2.8rem, 7vw, 5rem) !important;
			font-weight: 800;
			margin-bottom: 25px;
			line-height: 1.2;
			text-shadow: 0 4px 25px rgba(0, 0, 0, 0.4);
			animation: slideInUp 1s ease-out;
		}

		.hero-section .lead {
			font-size: 1.3rem !important;
			margin-bottom: 40px;
			max-width: 650px;
			text-shadow: 0 2px 15px rgba(0, 0, 0, 0.3);
			animation: slideInUp 1s ease-out 0.2s both;
		}

		@keyframes slideInUp {
			from {
				opacity: 0;
				transform: translateY(40px);
			}

			to {
				opacity: 1;
				transform: translateY(0);
			}
		}

		.hero-cta {
			background: rgba(255, 255, 255, 0.95);
			border: none;
			padding: 18px 45px;
			font-size: 1.15rem;
			font-weight: 700;
			border-radius: 50px;
			transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
			display: inline-block;
			margin-right: 20px;
			margin-bottom: 15px;
			color: #2563eb;
			box-shadow: 0 12px 35px rgba(0, 0, 0, 0.25);
			animation: slideInUp 1s ease-out 0.4s both;
			text-decoration: none;
		}

		.hero-cta:hover {
			transform: translateY(-5px) scale(1.02);
			background: white;
			box-shadow: 0 25px 50px rgba(37, 99, 235, 0.4);
		}

		.ai-badge {
			background: rgba(183, 182, 248, 0.2);
			    color: #b5caf7 !important;
			padding: 8px 16px;
			border-radius: 20px;
			font-size: 0.9rem;
			font-weight: 600;
			margin-bottom: 20px;
			display: inline-block;
			backdrop-filter: blur(10px);
			animation: slideInUp 1s ease-out 0.6s both;
		}
	</style>
</head>

<body>
	
	<!-- HERO SECTION - Simplified with Three.js Background -->
	<section class="hero-section" id="home">
		<!-- HERO CONTENT -->
		<div class="hero-content">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<span style="color: aliceblue;" class="ai-badge">+ AI-FIRST ENTERPRISE</span>
						<h1 style="font-size: 30px;">Custom Software Development<br>with AI Automation</h1>
						<p class="lead">Custom websites, mobile apps, reliable server maintenance, and hosting. Complete
							digital infrastructure for your business.</p>
						<div>
							<a href="<?= base_url() ?>index.php/welcome/ContactUs" class="hero-cta">Free AI Audit</a>
							<a href="<?= base_url() ?>index.php/welcome/Services" class="hero-cta">Explore Services</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<!-- STATS SECTION -->
	<section class="stats-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<div class="row">
						<div class="col-lg-3 col-md-6">
							<div class="stat-item">
								<div class="stat-number">320+</div>
								<div class="stat-label">Websites Delivered</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="stat-item">
								<div class="stat-number">50+</div>
								<div class="stat-label">AI Accuracy</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="stat-item">
								<div class="stat-number">70%</div>
								<div class="stat-label">Cost Reduction</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6">
							<div class="stat-item">
								<div class="stat-number">24/7</div>
								<div class="stat-label">Support</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- CORE SERVICES -->
	<section class="services-section" id="services">
		<div class="container">
			<div class="row justify-content-center text-center mb-5">
				<div class="col-lg-8">
					<h2 class="section-title">Website Development</h2>
					<p class="section-subtitle">Responsive websites with React/Next.js. E-commerce, corporate sites,
						Booking systems. SEO optimized, Mobile-first design.</p>
				</div>
			</div>
			<div class="row g-4 justify-content-center">
				<div class="col-lg-4 col-md-6">
					<div class="service-card">
						<div class="service-icon"><i class="fas fa-robot"></i></div>
						<h3 style="font-size: 1.5rem; margin-bottom: 15px; color: #1d3b7a;">Mobile App Development</h3>
						<p style="color: #1d3b7a;">iOS & Android apps with React Native. E-commerce apps, delivery apps,
							enterprise mobile solutions. App Store deployment.</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-card">
						<div class="service-icon"><i class="fas fa-code"></i></div>
						<h3 style="font-size: 1.5rem; margin-bottom: 15px; color: #1d3b7a;">Server Maintenance</h3>
						<p style="color: #1d3b7a;">24/7 server monitoring, security updates, performance optimization.
							Linux/Windows servers, cloud infrastructure management.</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-card">
						<div class="service-icon"><i class="fas fa-mobile-alt"></i></div>
						<h3 style="font-size: 1.5rem; margin-bottom: 15px; color: #1d3d83;">Hosting Services</h3>
						<p style="color: #1d3b7a;">High-performance hosting with CDN, SSL, daily backups. Shared, VPS,
							dedicated servers. Unlimited bandwidth options.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- AI INNOVATION SECTION -->
	<section class="ai-section">
		<div class="container">
			<div class="row justify-content-center text-center mb-5">
				<div class="col-lg-8">
					<span class="ai-badge mb-4">2025 AI LEADERSHIP</span>
					<h2 style="font-size: clamp(2.8rem, 6vw, 4.5rem);">AI Innovation Suite: Powering Enterprise 2025"
					</h2>
					<p style="color: #a6bdec;" class="lead mt-3"> "Next-generation AI capabilities driving enterprise
						transformation through automation, intelligent search, and visual intelligence."</p>
				</div>
			</div>
			<div class="row g-4">
				<div class="col-lg-4 col-md-6">
					<div class="service-card">
						<div class="service-icon"><i class="fas fa-brain"></i></div>
						<h3 style="color: #1d3d83;">AI Agents</h3>
						<p style="color: #1d3b7a;">"Intelligent agents automate complex workflows with minimal
							oversight. Context-aware decision-making handles tasks from customer support to supply chain
							optimization, cutting operational costs by up to 40%."</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-card">
						<div class="service-icon"><i class="fas fa-database"></i></div>
						<h3 style="color: #1d3d83;">RAG Systems</h3>
						<p style="color: #1d3b7a;">"Retrieval-Augmented Generation enables secure enterprise search
							across proprietary data. Chat seamlessly with documents, codebases, and knowledge bases for
							instant, accurate insights without hallucinations."</p>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="service-card">
						<div class="service-icon"><i class="fas fa-eye"></i></div>
						<h3 style="color: #1d3d83;">Computer Vision</h3>
						<p style="color: #1d3b7a;">"Advanced image recognition, document processing, and video analytics
							deliver operational excellence. Automate quality control, extract data from scans, and
							monitor processes in real-time for unmatched efficiency."</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- TRUST SECTION -->
	<section class="trust-section">
		<div class="container">
			<div class="row justify-content-center text-center mb-5">
				<div class="col-lg-8">
					<h2 style="font-size: clamp(2.8rem, 6vw, 4.5rem); color: #2563eb;">Trusted By Industry Leaders</h2>
				</div>
			</div>
			<div class="row text-center mb-5">
				<div class="col-lg-2 col-md-3 col-6 mb-4">
					<img src="<?= base_url(); ?>assets/g1.png" class="client-logo img-fluid" alt="TechCorp">
				</div>
				<div class="col-lg-2 col-md-3 col-6 mb-4">
					<img src="<?= base_url(); ?>assets/g2.png" class="client-logo img-fluid" alt="FinBank">
				</div>
				<div class="col-lg-2 col-md-3 col-6 mb-4">
					<img src="<?= base_url(); ?>assets/g3.png" class="client-logo img-fluid" alt="HealthIO">
				</div>
				<div class="col-lg-2 col-md-3 col-6 mb-4">
					<img src="<?= base_url(); ?>assets/g4.png" class="client-logo img-fluid" alt="Logistix">
				</div>
				<div class="col-lg-2 col-md-3 col-6 mb-4">
					<img src="<?= base_url(); ?>assets/g5.png" class="client-logo img-fluid" alt="EduTech">
				</div>
				<div class="col-lg-2 col-md-3 col-6 mb-4">
					<img src="<?= base_url(); ?>assets/g4.png" class="client-logo img-fluid" alt="Ecommerce Pro">
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-8 text-center">
					<h4 class="mb-4" style="color: #2563eb;">Certified AI Partners</h4>
					<div class="d-flex justify-content-center gap-4 flex-wrap">
						<img src="https://via.placeholder.com/140x55/2563eb/fff?text=OpenAI"
							class="ai-partner img-fluid" alt="OpenAI">
						<img src="https://via.placeholder.com/140x55/0ea5e9/fff?text=AWS+AI"
							class="ai-partner img-fluid" alt="AWS AI">
						<img src="https://via.placeholder.com/140x55/2563eb/fff?text=Azure+AI"
							class="ai-partner img-fluid" alt="Azure AI">
						<img src="https://via.placeholder.com/140x55/0ea5e9/fff?text=Google+AI"
							class="ai-partner img-fluid" alt="Google AI">
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- FINAL AI CTA -->
	<section class="cta-section" id="contact">
		<div class="container">
			<h2>Launch Your AI Transformation Today?</h2>
			<p class="lead">Deploy production-ready AI agents in just 2 weeks. Zero ML expertise needed. Achieve 95%+
				accuracy with our proven enterprise suite—no custom training required.
			</p>
			<div class="row justify-content-center">
				<div class="col-lg-5 col-md-8">
					<a href="<?= base_url() ?>index.php/welcome/ContactUs" class="cta-btn">Claim Free AI Audit</a>
					<a href="<?= base_url() ?>index.php/welcome/Services" class="cta-btn cta-btn-outline">Book Live Demo</a>
				</div>
			</div>
		</div>
	</section>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
	<script>
		// Smooth scroll for anchor links
		document.querySelectorAll('a[href^="#"]').forEach(anchor => {
			anchor.addEventListener('click', function (e) {
				e.preventDefault();
				document.querySelector(this.getAttribute('href')).scrollIntoView({
					behavior: 'smooth'
				});
			});
		});
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
	<script>
		// Initialize scene, camera, renderer
		const scene = new THREE.Scene();
		const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
		const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
		renderer.setSize(window.innerWidth, window.innerHeight);
		renderer.setClearColor(0x000000, 0);
		renderer.domElement.style.position = 'fixed';
		renderer.domElement.style.top = '0';
		renderer.domElement.style.left = '0';
		renderer.domElement.style.zIndex = '-1';
		renderer.domElement.style.pointerEvents = 'none';
		document.body.appendChild(renderer.domElement);

		// Materials aligned with gradient
		const nodeMaterial = new THREE.MeshStandardMaterial({
			color: 0x090979,
			emissive: 0x020024,
			metalness: 0.8,
			roughness: 0.2
		});
		const connectorMaterial = new THREE.MeshStandardMaterial({
			color: 0x00d4ff,
			emissive: 0x0482c9,
			transparent: true,
			opacity: 0.8,
			metalness: 0.9,
			roughness: 0.1
		});
		const wireframeMaterial = new THREE.MeshBasicMaterial({
			color: 0x00d4ff,
			wireframe: true,
			transparent: true,
			opacity: 0.3
		});

		// Particle system for flowing effect
		const particleCount = 500;
		const particles = new THREE.BufferGeometry();
		const positions = new Float32Array(particleCount * 3);
		const colors = new Float32Array(particleCount * 3);
		for (let i = 0; i < particleCount; i++) {
			positions[i * 3] = (Math.random() - 0.5) * 20;
			positions[i * 3 + 1] = (Math.random() - 0.5) * 20;
			positions[i * 3 + 2] = (Math.random() - 0.5) * 20;
			colors[i * 3] = Math.random() * 0.5 + 0.5;
			colors[i * 3 + 1] = Math.random() * 0.5 + 0.5;
			colors[i * 3 + 2] = 1;
		}
		particles.setAttribute('position', new THREE.BufferAttribute(positions, 3));
		particles.setAttribute('color', new THREE.BufferAttribute(colors, 3));
		const particleMaterial = new THREE.PointsMaterial({ size: 0.05, vertexColors: true, transparent: true, opacity: 0.6 });
		const particleSystem = new THREE.Points(particles, particleMaterial);
		scene.add(particleSystem);

		// Innovative geometric clusters: Mix of octahedrons, icosahedrons, and dodecahedrons for variety
		const nodes = [];
		const connectors = [];
		const clusterSize = 5; // Fewer but more complex clusters
		const nodeRadius = 0.15;
		const connectorRadius = 0.03;

		// Function to create a cluster with varying geometries
		function createCluster(type, scale, position) {
			const clusterGroup = new THREE.Group();
			let vertices = [];
			let edges = [];

			if (type === 'octahedron') {
				vertices = [
					new THREE.Vector3(1, 0, 0), new THREE.Vector3(-1, 0, 0),
					new THREE.Vector3(0, 1, 0), new THREE.Vector3(0, -1, 0),
					new THREE.Vector3(0, 0, 1), new THREE.Vector3(0, 0, -1)
				];
				edges = [
					[0, 2], [0, 3], [0, 4], [0, 5],
					[1, 2], [1, 3], [1, 4], [1, 5],
					[2, 4], [2, 5], [3, 4], [3, 5]
				];
			} else if (type === 'icosahedron') {
				// Icosahedron vertices (approximated)
				const t = (1 + Math.sqrt(5)) / 2;
				vertices = [
					new THREE.Vector3(-1, t, 0), new THREE.Vector3(1, t, 0),
					new THREE.Vector3(-1, -t, 0), new THREE.Vector3(1, -t, 0),
					new THREE.Vector3(0, -1, t), new THREE.Vector3(0, 1, t),
					new THREE.Vector3(0, -1, -t), new THREE.Vector3(0, 1, -t),
					new THREE.Vector3(t, 0, -1), new THREE.Vector3(t, 0, 1),
					new THREE.Vector3(-t, 0, -1), new THREE.Vector3(-t, 0, 1)
				];
				// Simplified edges for icosahedron
				edges = [
					[0, 1], [0, 5], [0, 7], [0, 10], [0, 11],
					[1, 5], [1, 7], [1, 8], [1, 9],
					[2, 3], [2, 4], [2, 6], [2, 10], [2, 11],
					[3, 4], [3, 6], [3, 8], [3, 9],
					[4, 5], [4, 9], [4, 11],
					[5, 9], [5, 11],
					[6, 7], [6, 8], [6, 10],
					[7, 8], [7, 10],
					[8, 9], [9, 10], [10, 11]
				];
			} else if (type === 'dodecahedron') {
				// Dodecahedron vertices (simplified)
				const phi = (1 + Math.sqrt(5)) / 2;
				vertices = [
					new THREE.Vector3(1, 1, 1), new THREE.Vector3(1, 1, -1),
					new THREE.Vector3(1, -1, 1), new THREE.Vector3(1, -1, -1),
					new THREE.Vector3(-1, 1, 1), new THREE.Vector3(-1, 1, -1),
					new THREE.Vector3(-1, -1, 1), new THREE.Vector3(-1, -1, -1),
					new THREE.Vector3(0, phi, 1 / phi), new THREE.Vector3(0, phi, -1 / phi),
					new THREE.Vector3(0, -phi, 1 / phi), new THREE.Vector3(0, -phi, -1 / phi),
					new THREE.Vector3(phi, 1 / phi, 0), new THREE.Vector3(phi, -1 / phi, 0),
					new THREE.Vector3(-phi, 1 / phi, 0), new THREE.Vector3(-phi, -1 / phi, 0),
					new THREE.Vector3(1 / phi, 0, phi), new THREE.Vector3(-1 / phi, 0, phi),
					new THREE.Vector3(1 / phi, 0, -phi), new THREE.Vector3(-1 / phi, 0, -phi)
				];
				// Simplified edges
				edges = [
					[0, 8], [0, 12], [0, 16], [1, 9], [1, 12], [1, 18],
					[2, 10], [2, 13], [2, 16], [3, 11], [3, 13], [3, 18],
					[4, 8], [4, 14], [4, 17], [5, 9], [5, 14], [5, 19],
					[6, 10], [6, 15], [6, 17], [7, 11], [7, 15], [7, 19],
					[8, 9], [10, 11], [12, 13], [14, 15], [16, 17], [18, 19]
				];
			}

			// Create nodes
			vertices.forEach(vertex => {
				const node = new THREE.Mesh(new THREE.SphereGeometry(nodeRadius, 16, 16), nodeMaterial);
				node.position.copy(vertex).multiplyScalar(scale);
				clusterGroup.add(node);
				nodes.push(node);
			});

			// Create connectors
			edges.forEach(([a, b]) => {
				const start = vertices[a].clone().multiplyScalar(scale);
				const end = vertices[b].clone().multiplyScalar(scale);
				const direction = end.clone().sub(start);
				const length = direction.length();
				const connector = new THREE.Mesh(new THREE.CylinderGeometry(connectorRadius, connectorRadius, length, 8), connectorMaterial);
				connector.position.copy(start).add(direction.multiplyScalar(0.5));
				connector.lookAt(end);
				clusterGroup.add(connector);
				connectors.push(connector);
			});

			// Add wireframe overlay for crystalline effect
			const wireframeGeo = type === 'octahedron' ? new THREE.OctahedronGeometry(scale) :
				type === 'icosahedron' ? new THREE.IcosahedronGeometry(scale) :
					new THREE.DodecahedronGeometry(scale);
			const wireframe = new THREE.Mesh(wireframeGeo, wireframeMaterial);
			clusterGroup.add(wireframe);

			clusterGroup.position.copy(position);
			scene.add(clusterGroup);
		}

		// Create varied clusters
		createCluster('octahedron', 1, new THREE.Vector3(-6, 0, 0));
		createCluster('icosahedron', 0.8, new THREE.Vector3(-3, 1, 0));
		createCluster('dodecahedron', 0.7, new THREE.Vector3(0, 0, 0));
		createCluster('octahedron', 1.2, new THREE.Vector3(3, -1, 0));
		createCluster('icosahedron', 0.9, new THREE.Vector3(6, 0, 0));

		// Lights
		nodes.forEach((node, i) => {
			const lightColor = i % 3 === 0 ? 0x00d4ff : i % 3 === 1 ? 0x090979 : 0x0482c9;
			const light = new THREE.PointLight(lightColor, 0.7, 4);
			light.position.copy(node.position);
			scene.add(light);
		});
		const ambientLight = new THREE.AmbientLight(0x060552, 0.4);
		scene.add(ambientLight);
		const directionalLight = new THREE.DirectionalLight(0x00d4ff, 0.6);
		directionalLight.position.set(5, 5, 5);
		scene.add(directionalLight);

		// Camera
		camera.position.set(0, 3, 15);

		// Mouse interaction
		let mouseX = 0, mouseY = 0;
		document.addEventListener('mousemove', (event) => {
			mouseX = (event.clientX / window.innerWidth) * 2 - 1;
			mouseY = -(event.clientY / window.innerHeight) * 2 + 1;
		});

		// Animation loop
		function animate() {
			requestAnimationFrame(animate);
			scene.rotation.y += 0.002;
			camera.position.x += (mouseX * 3 - camera.position.x) * 0.05;
			camera.position.y += (mouseY * 3 - camera.position.y) * 0.05;
			camera.lookAt(0, 0, 0);

			// Animate particles
			const positions = particleSystem.geometry.attributes.position.array;
			for (let i = 0; i < particleCount; i++) {
				positions[i * 3 + 1] += Math.sin(Date.now() * 0.001 + i) * 0.01;
			}
			particleSystem.geometry.attributes.position.needsUpdate = true;

			connectors.forEach((conn, i) => {
				conn.material.emissiveIntensity = 0.7 + 0.3 * Math.sin(Date.now() * 0.0008 + i * 0.5);
			});
			renderer.render(scene, camera);
		}
		animate();

		// Resize
		window.addEventListener('resize', () => {
			camera.aspect = window.innerWidth / window.innerHeight;
			camera.updateProjectionMatrix();
			renderer.setSize(window.innerWidth, window.innerHeight);
		});
	</script>
</body>

</html>