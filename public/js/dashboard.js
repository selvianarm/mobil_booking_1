document.addEventListener("DOMContentLoaded", function () {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    let current = 0;
    const total = slides.length;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.remove('active');
            if (i === index) slide.classList.add('active');
        });

        dots.forEach(dot => dot.classList.remove('active'));
        dots[index].classList.add('active');

        current = index;
    }

    function autoSlide() {
        const next = (current + 1) % total;
        showSlide(next);
    }

    let slideInterval = setInterval(autoSlide, 5000); // slide tiap 7 detik

    dots.forEach((dot, idx) => {
        dot.addEventListener("click", () => {
            clearInterval(slideInterval);
            showSlide(idx);
            slideInterval = setInterval(autoSlide, 5000);
        });
    });

    showSlide(current);
});

function initializeDashboard() {
    setDefaultDates();
    initializeFormValidation();
    createParticleEffect();
    handleAlertMessages();
    addSubmitHandler();
    initializeSidebarToggle(); // ← tambahkan ini
}

// Set default dates and times
function setDefaultDates() {
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);

    const startDateInput = document.getElementById('start-date');
    const endDateInput = document.getElementById('end-date');
    const startTimeInput = document.getElementById('start-time');
    const endTimeInput = document.getElementById('end-time');

    if (startDateInput) startDateInput.value = today.toISOString().split('T')[0];
    if (endDateInput) endDateInput.value = tomorrow.toISOString().split('T')[0];
    if (startTimeInput) startTimeInput.value = '09:00';
    if (endTimeInput) endTimeInput.value = '17:00';
}


// Form validation logic
function initializeFormValidation() {
    const form = document.getElementById('bookingForm');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        if (!validateBookingForm()) {
            e.preventDefault();
        } else {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                submitBtn.disabled = true;
            }
        }
    });

    const inputs = form.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('blur', validateInput);
        input.addEventListener('input', () => clearFieldError(input));
    });
}

function validateBookingForm() {
    const form = document.getElementById('bookingForm');
    if (!form) return true;

    let isValid = true;
    const requiredFields = form.querySelectorAll('[required]');

    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            showFieldError(field, 'Field ini wajib diisi');
            isValid = false;
        } else {
            clearFieldError(field);
        }
    });

    const startDate = document.getElementById('start-date');
    const endDate = document.getElementById('end-date');
    const startTime = document.getElementById('start-time');
    const endTime = document.getElementById('end-time');

    if (startDate && endDate && startDate.value && endDate.value) {
        const startDateTime = new Date(`${startDate.value}T${startTime?.value || '00:00'}`);
        const endDateTime = new Date(`${endDate.value}T${endTime?.value || '23:59'}`);

        if (startDateTime >= endDateTime) {
            showFieldError(endDate, 'Tanggal selesai harus setelah tanggal mulai');
            isValid = false;
        }

        if (startDateTime < new Date()) {
            showFieldError(startDate, 'Tanggal tidak boleh di masa lalu');
            isValid = false;
        }
    }

    if (!isValid) {
        showNotification('Mohon periksa kembali form Anda', 'error');
    }

    return isValid;
}

function validateInput(e) {
    const input = e.target;

    if (input.hasAttribute('required') && !input.value.trim()) {
        showFieldError(input, 'Field ini wajib diisi');
        return false;
    }

    if (input.type === 'email' && input.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(input.value)) {
            showFieldError(input, 'Format email tidak valid');
            return false;
        }
    }

    clearFieldError(input);
    return true;
}

function showFieldError(field, message) {
    clearFieldError(field);

    field.style.borderColor = '#ef4444';
    field.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.1)';

    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.style.cssText = `
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
        animation: slideInUp 0.3s ease-out;
    `;
    errorDiv.textContent = message;

    field.parentNode.appendChild(errorDiv);
}

function clearFieldError(field) {
    const errorDiv = field.parentNode.querySelector('.field-error');
    if (errorDiv) {
        errorDiv.remove();
    }
    field.style.borderColor = '';
    field.style.boxShadow = '';
}

// Sidebar toggle functionality
function initializeSidebarToggle() {
    const toggleBtn = document.getElementById('toggle-btn');
    const navMenu = document.getElementById('topnav-menu');

    if (!toggleBtn || !navMenu) return;

    toggleBtn.addEventListener('click', () => {
        navMenu.classList.toggle('show');
        toggleBtn.textContent = navMenu.classList.contains('show') ? '✕' : '☰';
    });

    document.addEventListener('click', (e) => {
        const isClickInside = toggleBtn.contains(e.target) || navMenu.contains(e.target);
        if (!isClickInside) {
            navMenu.classList.remove('show');
            toggleBtn.textContent = '☰';
        }
    });
}


// Optional: For inline alert handling
function handleAlertMessages() {
    const alerts = document.querySelectorAll('.alert-message');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.display = 'none';
        }, 4000);
    });
}

// Manual submit handler
function addSubmitHandler() {
    const manualBtn = document.getElementById('manual-submit');
    if (!manualBtn) return;

    manualBtn.addEventListener('click', function () {
        const destination = document.getElementById('destination').value;
        const purpose = document.getElementById('purpose').value;

        if (!destination || !purpose) {
            showNotification('Mohon lengkapi semua field!', 'error');
            return;
        }

        showNotification('Booking berhasil disubmit! Menunggu approval.', 'success');
        document.getElementById('destination').value = '';
        document.getElementById('purpose').value = '';
    });
}

// Notification system
function showNotification(message = 'Fitur dalam pengembangan!', type = 'info') {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 2rem;
        right: 2rem;
        background: ${type === 'success' ? '#10b981' :
                     type === 'error' ? '#ef4444' :
                     '#3b82f6'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        z-index: 10000;
        animation: slideInDown 0.3s ease-out;
        max-width: 300px;
        font-weight: 500;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideInUp 0.3s ease-out reverse';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// Floating particle effect
function createParticleEffect() {
    const style = document.createElement('style');
    style.textContent = `
        @keyframes float-particle {
            0% { transform: translateY(0) rotate(0deg); opacity: 0; }
            10%, 90% { opacity: 1; }
            100% { transform: translateY(-100vh) rotate(360deg); opacity: 0; }
        }
    `;
    document.head.appendChild(style);

    setInterval(() => {
        const particle = document.createElement('div');
        particle.style.cssText = `
            position: fixed;
            width: 4px;
            height: 4px;
            background: rgba(255,255,255,0.6);
            border-radius: 50%;
            pointer-events: none;
            z-index: -1;
            animation: float-particle 8s linear infinite;
        `;
        particle.style.left = `${Math.random() * window.innerWidth}px`;
        particle.style.top = `${window.innerHeight}px`;
        document.body.appendChild(particle);
        setTimeout(() => {
            particle.remove();
        }, 8000);
    }, 2000);
}
