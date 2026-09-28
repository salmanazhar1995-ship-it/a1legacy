(() => {
    'use strict';

    const ready = (callback) => {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', callback, { once: true });
        } else {
            callback();
        }
    };

    ready(() => {
        const root = document.getElementById('a1-ai-agents');

        if (!root) {
            return;
        }

        const notice = document.getElementById('a1-agent-notice');
        const chatEnabled = root.dataset.chatEnabled === 'true';
        const voiceEnabled = root.dataset.voiceEnabled === 'true';
        let noticeTimer = null;
        let voicePositionAttempts = 0;
        const observedRetellRoots = new WeakSet();
        const observedChatWidgets = new WeakSet();

        const showNotice = (message, duration = 5000) => {
            if (!notice) {
                return;
            }

            window.clearTimeout(noticeTimer);
            notice.textContent = message;
            notice.hidden = false;
            noticeTimer = window.setTimeout(() => {
                notice.hidden = true;
                notice.textContent = '';
            }, duration);
        };

        const horizontalGap = () => window.matchMedia('(min-width: 640px)').matches ? '24px' : '16px';
        const bottomGap = () => window.matchMedia('(min-width: 640px)').matches ? '24px' : '16px';

        const closeChatWidget = () => {
            const chatWidget = window.leadConnector?.chatWidget;

            if (chatWidget?.isActive?.()) {
                chatWidget.closeWidget();
            }
        };

        const collectOpenShadowRoots = (element, roots = []) => {
            if (!element?.querySelectorAll) {
                return roots;
            }

            if (element.shadowRoot) {
                roots.push(element.shadowRoot);
                collectOpenShadowRoots(element.shadowRoot, roots);
            }

            element.querySelectorAll('*').forEach((child) => {
                if (child.shadowRoot) {
                    roots.push(child.shadowRoot);
                    collectOpenShadowRoots(child.shadowRoot, roots);
                }
            });

            return roots;
        };

        const styleRetellShadowRoot = (shadowRoot) => {
            const launcher = shadowRoot.querySelector([
                'button[aria-label="Open Assistant"]',
                'button[aria-label="Minimize window"]',
                'button[aria-label="Return to active call"]',
            ].join(','));
            const launcherWrapper = launcher?.parentElement;
            const bottomStack = launcherWrapper?.parentElement;
            const widgetContainer = bottomStack?.parentElement;
            const gap = horizontalGap();
            const bottom = bottomGap();

            if (widgetContainer) {
                widgetContainer.style.setProperty('left', gap, 'important');
                widgetContainer.style.setProperty('right', 'auto', 'important');
                widgetContainer.style.setProperty('bottom', bottom, 'important');
            }

            if (launcherWrapper) {
                launcherWrapper.style.setProperty('justify-content', 'flex-start', 'important');
            }

            if (bottomStack) {
                bottomStack.style.setProperty('align-items', 'flex-start', 'important');

                const providerBranding = Array.from(bottomStack.children)
                    .find((element) => element.textContent?.trim().startsWith('Powered by'));

                if (providerBranding) {
                    providerBranding.style.setProperty('width', '100%', 'important');
                    providerBranding.style.setProperty('text-align', 'center', 'important');

                    const providerLink = providerBranding.querySelector('a');

                    if (providerLink) {
                        providerLink.textContent = 'A1Legacy';
                        providerLink.href = `${window.location.origin}/`;
                        providerLink.target = '_self';
                        providerLink.removeAttribute('rel');
                    }
                }
            }

            if (widgetContainer && bottomStack) {
                Array.from(widgetContainer.children)
                    .filter((element) => element !== bottomStack && String(element.className).includes('_window_'))
                    .forEach((windowPanel) => {
                        windowPanel.style.setProperty('position', 'fixed', 'important');
                        windowPanel.style.setProperty('top', 'auto', 'important');
                        windowPanel.style.setProperty('left', gap, 'important');
                        windowPanel.style.setProperty('right', 'auto', 'important');
                        windowPanel.style.setProperty('bottom', `calc(${bottom} + 68px + env(safe-area-inset-bottom, 0px))`, 'important');
                        windowPanel.style.setProperty('width', 'min(350px, calc(100vw - 32px))', 'important');
                        windowPanel.style.setProperty('max-height', `calc(100dvh - ${bottom} - 84px)`, 'important');
                        windowPanel.style.setProperty(
                            'transform',
                            String(windowPanel.className).includes('_windowClosed_')
                                ? 'translateY(16px) scale(.96)'
                                : 'translateY(0) scale(1)',
                            'important',
                        );
                        windowPanel.style.setProperty('transform-origin', 'bottom left', 'important');
                    });
            }

            shadowRoot.querySelectorAll('[class*="_popup_"]').forEach((popup) => {
                if (getComputedStyle(popup).position !== 'fixed') {
                    return;
                }

                popup.style.setProperty('left', gap, 'important');
                popup.style.setProperty('right', 'auto', 'important');
            });

            if (!observedRetellRoots.has(shadowRoot)) {
                const retellObserver = new MutationObserver(() => {
                    if (shadowRoot.querySelector('button[aria-label="Minimize window"]')) {
                        closeChatWidget();
                    } else if (window.leadConnector?.chatWidget?.isActive?.()) {
                        shadowRoot.querySelector('button[aria-label="Close"]')?.click();
                    }

                    window.requestAnimationFrame(positionRetellWidget);
                });
                retellObserver.observe(shadowRoot, {
                    attributes: true,
                    attributeFilter: ['aria-label', 'class'],
                    childList: true,
                    characterData: true,
                    subtree: true,
                });
                observedRetellRoots.add(shadowRoot);
            }
        };

        const closeVoiceWidget = () => {
            const retellHost = document.getElementById('retell-widget-root');

            if (!retellHost) {
                return;
            }

            collectOpenShadowRoots(retellHost).some((shadowRoot) => {
                const closeButton = shadowRoot.querySelector([
                    'button[aria-label="Minimize window"]',
                    'button[aria-label="Close"]',
                ].join(','));

                if (!closeButton) {
                    return false;
                }

                closeButton.click();

                return true;
            });
        };

        const positionRetellWidget = () => {
            const retellHost = document.getElementById('retell-widget-root');

            if (!retellHost) {
                return false;
            }

            const gap = horizontalGap();
            const bottom = bottomGap();
            retellHost.style.setProperty('left', gap, 'important');
            retellHost.style.setProperty('right', 'auto', 'important');
            retellHost.style.setProperty('bottom', bottom, 'important');

            collectOpenShadowRoots(retellHost).forEach((shadowRoot) => {
                styleRetellShadowRoot(shadowRoot);
            });

            return true;
        };

        const ensureRetellPosition = () => {
            if (!voiceEnabled) {
                return;
            }

            positionRetellWidget();
            voicePositionAttempts += 1;

            if (voicePositionAttempts < 120) {
                window.setTimeout(ensureRetellPosition, 150);
            }
        };

        window.addEventListener('LC_chatWidgetLoaded', (event) => {
            if (!chatEnabled) {
                return;
            }

            if (event.detail && !observedChatWidgets.has(event.detail)) {
                const chatObserver = new MutationObserver(() => {
                    if (window.leadConnector?.chatWidget?.isActive?.()) {
                        closeVoiceWidget();
                    }
                });

                chatObserver.observe(event.detail, {
                    attributes: true,
                    childList: true,
                    subtree: true,
                });
                observedChatWidgets.add(event.detail);
            }

            if (window.leadConnector?.chatWidget?.isActive?.()) {
                closeVoiceWidget();
            }
        });

        const observer = new MutationObserver(() => {
            if (voiceEnabled) {
                positionRetellWidget();
            }
        });

        observer.observe(document.documentElement, { childList: true, subtree: true });

        window.addEventListener('resize', () => {
            if (voiceEnabled) {
                positionRetellWidget();
            }
        }, { passive: true });

        window.addEventListener('error', (event) => {
            const source = String(event?.filename || event?.target?.src || '');

            if (source.includes('leadconnectorhq.com')) {
                showNotice('Chat Agent is temporarily unavailable.');
            }

            if (source.includes('retellai.com')) {
                showNotice('Voice Agent is temporarily unavailable.');
            }
        }, true);

        ensureRetellPosition();
    });
})();
