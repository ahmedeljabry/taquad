class BladewindSelect {
    clickArea;
    rootElement;
    rootNode;
    itemsContainer;
    filterInput;
    selectItems;
    isMultiple;
    displayArea;
    formInput;

    constructor(name, placeholder, componentId, model = null) {
               this.model                    = model;
               this.name                     = name;
               this.placeholder              = placeholder || 'Select One';
               this.componentId              = componentId;
               this.rootElement              = `.bw-select-${name}`;

        this.setupDomReferences();
    }
    
    setupDomReferences = () => {
        this.rootNode = dom_el(this.rootElement);
        if (!this.rootNode) {
            this.initialized = false;
            return false;
        }
        this.initialized = true;
        this.clickArea      = `${this.rootElement} .clickable`;
        this.displayArea    = `${this.rootElement} .display-area`;
        this.itemsContainer = `${this.rootElement} .bw-select-items-container`;
        this.filterInput    = `${this.itemsContainer} .bw_filter`;
        this.selectItems    = `${this.itemsContainer} .bw-select-items .bw-select-item`;
        this.isMultiple     = (this.rootNode.getAttribute('data-multiple') === 'true');
        this.formInput      = `input.bw-${this.name}`;

        const displayAreaEl = dom_el(this.displayArea);
        if (displayAreaEl) displayAreaEl.style.width = `${(this.rootNode.offsetWidth-40)}px`;
        return true;
    }
    
    activate = () => {
        if (!this.initialized) {
            // Attempt to locate the DOM once more in case we were instantiated before Livewire rendered the markup
            if (!this.setupDomReferences()) {
                requestAnimationFrame(() => this.activate());
                return;
            }
        }
        const clickAreaEl = dom_el(this.clickArea);
        if (!clickAreaEl) return;
        clickAreaEl.addEventListener('click', () => unhide(this.itemsContainer));
        this.hide();
        this.filter();
        this.manualModePreSelection();
        this.selectItem();
    }

    hide = () => {
        if (!this.initialized) return;
        const itemsContainerEl = dom_el(this.itemsContainer);
        if (!itemsContainerEl) return;
        document.addEventListener('mouseup', (e) => {
            let searchArea = dom_el(this.filterInput);
            let container = dom_el((this.isMultiple) ? this.itemsContainer : this.clickArea) || itemsContainerEl;
            if (searchArea !== null && !searchArea.contains(e.target) && !container.contains(e.target)) hide(this.itemsContainer);
        }); 
    }

    filter = () => {
        if (!this.initialized) return;
        const filterInputEl = dom_el(this.filterInput);
        if (!filterInputEl) return;
        dom_el(this.filterInput).addEventListener('keyup', (e) => {
            let value = (dom_el(this.filterInput).value);
            dom_els(this.selectItems).forEach((el) => {
                (el.innerText.toLowerCase().indexOf(value.toLowerCase()) !== -1) ? unhide(el, true) : hide(el, true);
            });
        });
    }

    /**
     * When using non-dynamic selects, ensure select_value=<value>
     * works the same way as for dynamic selects. This saves the use from
     * manually checking if each select-item should be selected or not.
     */
    manualModePreSelection = () => {
        if (!this.initialized) return;
        let select_mode = dom_el(`${this.rootElement}`).getAttribute('data-type');
        let selected_value = dom_el(`${this.rootElement}`).getAttribute('data-selected-value');
        if(select_mode === 'manual' && selected_value !== null) {
            const items = dom_els(this.selectItems);
            if(!items) return;
            items.forEach((el) => {
                let item_value = el.getAttribute('data-value');
                if (item_value === selected_value) el.setAttribute('data-selected', true);
            });
        }
    }

    selectItem = () => {
        if (!this.initialized) return;
        const items = dom_els(this.selectItems);
        if(!items) return;
        items.forEach((el) => {
            let selected = (el.getAttribute('data-selected') !== null);
            let user_function = el.getAttribute('data-user-function');
            if(selected) this.setValue(el);
            el.addEventListener('click', (e) => {
                if(user_function !== null && user_function !== undefined) {
                    callUserFunction(`${user_function}('${el.getAttribute('data-value')}', '${el.getAttribute('data-label')}')`);
                }
                this.setValue(el);
            });
        });
    }

    setValue = (item) => {
        let selectedValue = item.getAttribute('data-value');
        let selectedLabel = item.getAttribute('data-label');
        let svg = item.children[item.children.length-1];
        hide(`${this.rootElement} .placeholder`);
        unhide(this.displayArea);
        
        if(! this.isMultiple) {
            changeCssForDomArray(`${this.selectItems} svg`, 'hidden');
            dom_el(this.displayArea).innerText = selectedLabel;
            dom_el(this.formInput).value       = selectedValue;
            this.refreshModel();
            // unhide(`${this.clickArea} .reset`);
            unhide(svg, true);
            // dom_el(`${this.clickArea} .reset`).addEventListener('click', (e) => {
            //     this.unsetValue(item);
            //     e.stopImmediatePropagation();
            // });
        } else {
            unhide(svg, true);
            if(dom_el(`input.bw-${this.name}`).value.indexOf(`,${selectedValue}`) !== -1){
                this.unsetValue(item);
            } else {
                dom_el(this.formInput).value += `,${selectedValue}`;
                dom_el(this.displayArea).innerHTML += this.labelTemplate(selectedLabel, selectedValue);
                this.removeLabel(selectedValue);
                this.refreshModel();
            }
            this.scrollers();
        }
        changeCss(`${this.clickArea}`, '!border-error-400', 'remove');
    }
    
    unsetValue = (item) => {
        let selectedValue = item.getAttribute('data-value');
        let svg = item.children[item.children.length-1];
        if(! this.isMultiple) {
            unhide(`${this.rootElement} .placeholder`);
            changeCssForDomArray(`${this.selectItems} svg`, 'hidden');
            dom_el(this.displayArea).innerText = '';
            dom_el(this.formInput).value = '';
            this.refreshModel();
            hide(this.displayArea);
            // hide(`${this.clickArea} .reset`);
        } else {
            dom_el(this.formInput).value = dom_el(this.formInput).value.replace(`,${selectedValue}`,'');
            dom_el(`${this.displayArea} span.bw-sp-${selectedValue}`).remove();
            this.refreshModel();
            if(dom_el(this.displayArea).innerText === '') {
                unhide(`${this.rootElement} .placeholder`);
                hide(this.displayArea);
            }
        }
        hide(svg, true);
    }

    scrollers = () => {
        if (!this.initialized) return;
        const displayAreaEl = dom_el(this.displayArea);
        const clickAreaEl = dom_el(this.clickArea);
        if(!displayAreaEl || !clickAreaEl) return;
        if(displayAreaEl.scrollWidth > this.rootNode.clientWidth) {
            unhide(`${this.clickArea} .scroll-left`);
            unhide(`${this.clickArea} .scroll-right`);
            const scrollRight = dom_el(`${this.clickArea} .scroll-right`);
            const scrollLeft  = dom_el(`${this.clickArea} .scroll-left`);
            if(scrollRight) scrollRight.addEventListener('click', (e) => {
                this.scroll(150);
                e.stopImmediatePropagation();
            });
            if(scrollLeft) scrollLeft.addEventListener('click', (e) => {
                this.scroll(-150);
                e.stopImmediatePropagation();
            });
        } else {
            hide(`${this.clickArea} .scroll-left`);
            hide(`${this.clickArea} .scroll-right`);
        }
    }

    scroll = (amount) => {  
        if (!this.initialized) return;
        const displayAreaEl = dom_el(this.displayArea);
        if(!displayAreaEl) return;
        displayAreaEl.scrollBy(amount,0);  
        ((displayAreaEl.clientWidth + displayAreaEl.scrollLeft) >= 
            displayAreaEl.scrollWidth) ? hide(`${this.clickArea} .scroll-right`) : unhide(`${this.clickArea} .scroll-right`);
         (displayAreaEl.scrollLeft === 0) ? hide(`${this.clickArea} .scroll-left`) : unhide(`${this.clickArea} .scroll-left`);
    }

    labelTemplate = (label, value) => {
        return `<span class="bg-slate-200 hover:bg-slate-300 inline-flex items-center text-slate-700 py-[2.5px] pl-2.5 pr-1 `+
                `mr-2 text-sm rounded-md bw-sp-${value} animate__animated animate__bounceIn animate__faster" `+
                `onclick="event.stopPropagation();window.event.cancelBubble = true">${label}`+ 
                `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" `+
                `class="w-5 h-5 fill-slate-400 hover:fill-slate-600 text-slate-100" data-value="${value}"><path stroke-linecap="round" `+
                `stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></span>`;
    }

    removeLabel = () => {
        if (!this.initialized) return;
        const labels = dom_els(`${this.displayArea} span svg`);
        if(!labels) return;
        labels.forEach((el) => {
            el.addEventListener('click', (e) => {
                let value = el.getAttribute('data-value');
                this.unsetValue(dom_el(`.bw-select-item[data-value="${value}"]`));
            });
        });
    }

    selectByValue = (value) => {
        dom_els(this.selectItems).forEach( (el) => {
            if (el.getAttribute('data-value') === value) this.setValue(el);
        });
    }

    refreshModel = () => {
        if (!this.initialized) return;
        const element = dom_el(this.formInput);
        if (!element) return;

        try {
            element.dispatchEvent(new Event('input', { bubbles: true }));
            element.dispatchEvent(new Event('change', { bubbles: true }));
        } catch (error) {
            console.error(error);
        }

        if (this.componentId && this.model && window.Livewire && typeof window.Livewire.dispatch === 'function') {
            try {
                // Support older Bladewind behaviour while keeping Livewire 2 compatibility if available
                const component = window.Livewire.find ? window.Livewire.find(this.componentId) : null;
                if (component && typeof component.set === 'function') {
                    component.set(this.model, element.value);
                }
            } catch (error) {
                console.warn('Bladewind select fallback Livewire sync failed:', error);
            }
        }
    }

    reset = () => {
        if (!this.initialized) return;
        const items = dom_els(this.selectItems);
        if(items) items.forEach( (el) => { this.unsetValue(el); });
        hide(this.displayArea);
        unhide(this.placeholder);
    }

    disable = () => {
        if (!this.initialized) return;
        changeCss(this.clickArea, 'opacity-40, select-none, cursor-not-allowed');
        changeCss(this.clickArea, 'focus:border-blue-400, cursor-pointer', 'remove');
        // hide(`${this.clickArea} .reset`);
        dom_el(this.clickArea).addEventListener('click', (e) => {
            hide(this.itemsContainer);
        });
    }

    enable = () => {
        if (!this.initialized) return;
        changeCss(this.clickArea, 'opacity-40, select-none, cursor-not-allowed', 'remove');
        changeCss(this.clickArea, 'focus:border-blue-400, cursor-pointer');
        dom_el(this.clickArea).addEventListener('click', (e) => {
            unhide(this.itemsContainer);
        });
    }


}
