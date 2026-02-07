/**
 * Ecomolimpo Countdown Timer Widget
 * 
 * @package Ecomolimpo_Widgets
 * @author Diego Cárdenas
 * @copyright 2025 Ecomolimpo
 */

(function($) {
    'use strict';

    class EcomolimpoCountdownTimer {
        constructor(element) {
            this.$element = $(element);
            this.id = this.$element.attr('id');
            this.minMinutes = parseInt(this.$element.data('min-minutes')) || 20;
            this.maxMinutes = parseInt(this.$element.data('max-minutes')) || 30;
            this.timeFormat = this.$element.data('time-format') || 'mm_ss';
            this.storageKey = 'ecomolimpo_countdown_' + this.id;
            
            this.init();
        }

        init() {
            // Get or create countdown end time
            let endTime = this.getEndTime();
            
            if (!endTime || endTime <= Date.now()) {
                // Create new random countdown
                endTime = this.createNewCountdown();
            }
            
            // Save to localStorage
            this.saveEndTime(endTime);
            
            // Start the countdown
            this.startCountdown(endTime);
        }

        getEndTime() {
            try {
                const stored = localStorage.getItem(this.storageKey);
                if (stored) {
                    return parseInt(stored);
                }
            } catch (e) {
                console.warn('localStorage not available:', e);
            }
            return null;
        }

        saveEndTime(endTime) {
            try {
                localStorage.setItem(this.storageKey, endTime.toString());
            } catch (e) {
                console.warn('Could not save to localStorage:', e);
            }
        }

        createNewCountdown() {
            // Generate random minutes between min and max
            const randomMinutes = Math.floor(
                Math.random() * (this.maxMinutes - this.minMinutes + 1)
            ) + this.minMinutes;
            
            // Calculate end time (current time + random minutes)
            const endTime = Date.now() + (randomMinutes * 60 * 1000);
            
            return endTime;
        }

        startCountdown(endTime) {
            // Clear any existing interval to prevent duplicates
            if (this.intervalId) {
                clearInterval(this.intervalId);
            }

            const updateTimer = () => {
                const now = Date.now();
                const timeLeft = endTime - now;

                if (timeLeft < 1000) { // Less than 1 second left
                    // Time's up - create new countdown
                    clearInterval(this.intervalId); // Stop current interval
                    
                    const newEndTime = this.createNewCountdown();
                    this.saveEndTime(newEndTime);
                    this.startCountdown(newEndTime); // Start new one
                    return;
                }

                // Calculate hours, minutes, seconds
                const totalSeconds = Math.floor(timeLeft / 1000);
                const hours = Math.floor(totalSeconds / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;

                // Update display
                this.updateDisplay(hours, minutes, seconds);
            };

            // Update immediately
            updateTimer();

            // Update every second
            this.intervalId = setInterval(updateTimer, 1000);
        }

        updateDisplay(hours, minutes, seconds) {
            // Pad numbers with leading zero
            const pad = (num) => String(num).padStart(2, '0');

            // Update each number element
            if (this.timeFormat === 'hh_mm_ss') {
                const $hours = this.$element.find('[data-type="hours"]');
                if ($hours.length > 0) {
                    $hours.text(pad(hours));
                }
            }
            
            const $minutes = this.$element.find('[data-type="minutes"]');
            if ($minutes.length > 0) {
                // For MM:SS format, show total minutes instead of just remaining minutes after hours
                if (this.timeFormat === 'mm_ss') {
                    const totalMinutes = (hours * 60) + minutes;
                    $minutes.text(pad(totalMinutes));
                } else {
                    $minutes.text(pad(minutes));
                }
            }
            
            const $seconds = this.$element.find('[data-type="seconds"]');
            if ($seconds.length > 0) {
                $seconds.text(pad(seconds));
            }
        }
    }

    // Initialize on document ready
    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/ecomolimpo_countdown_timer.default', function($scope) {
            // Check for both inline and box styles
            const $timer = $scope.find('.ecomolimpo-countdown-timer, .ecomolimpo-countdown-inline');
            if ($timer.length > 0) {
                new EcomolimpoCountdownTimer($timer[0]);
            }
        });
    });

    // Also initialize for non-Elementor contexts
    $(document).ready(function() {
        $('.ecomolimpo-countdown-timer, .ecomolimpo-countdown-inline').each(function() {
            new EcomolimpoCountdownTimer(this);
        });
    });

})(jQuery);
