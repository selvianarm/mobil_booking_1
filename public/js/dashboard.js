        // Add smooth scrolling and interactive elements
        document.querySelector('.reserve-btn').addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });

        // Parallax effect for floating elements
        document.addEventListener('mousemove', function(e) {
            const circles = document.querySelectorAll('.floating-circle');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            circles.forEach((circle, index) => {
                const speed = (index + 1) * 0.5;
                const xOffset = (x - 0.5) * speed * 20;
                const yOffset = (y - 0.5) * speed * 20;
                
                circle.style.transform = translate(${xOffset}px, ${yOffset}px);
            });
        });

        // Add counter animation on load
        function animateCounter(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const current = Math.floor(progress * (end - start) + start);
                element.textContent = current;
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Trigger animations on page load
        window.addEventListener('load', () => {
            const statNumbers = document.querySelectorAll('.stat-number');
            const values = [1.9, 400, 1000];
            
            statNumbers.forEach((stat, index) => {
                setTimeout(() => {
                    if (index === 0) {
                        let current = 0;
                        const increment = 1.9 / 100;
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= 1.9) {
                                current = 1.9;
                                clearInterval(timer);
                            }
                            stat.textContent = current.toFixed(1);
                        }, 20);
                    } else {
                        animateCounter(stat, 0, values[index], 2000);
                    }
                }, index * 200);
            });
        });