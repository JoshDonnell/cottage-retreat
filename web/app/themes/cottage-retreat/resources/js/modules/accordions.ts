/**
 * Accordions Module
 * 
 * Simple script to toggle accordion states.
 */

export const Accordions = () => {
	type AccordionItem = {
	  element: Element,
		parent: ParentNode,
		content: HTMLElement,
		height?: number,
		icon: HTMLElement,
		active: boolean,
	}

	// Options to limit to one active accordion
	const options = {
		limitToOneOpen: true
	}

	// Set the triggers for the Accordions
	const accordionElements = document.querySelectorAll('.js-accordion-trigger');

	// Check if we have accordions
	if (accordionElements.length) {
		// Setup our accordaions array
		const accordions:AccordionItem[] = [];

		// Loop over the accordions
		accordionElements.forEach((accordionElement:HTMLElement) => {
			// Set our accord object
			const accordion:AccordionItem = {
				element: accordionElement,
				parent: accordionElement.parentNode,
				content: accordionElement.parentNode.querySelector('.js-accordion-content'),
				icon: accordionElement.querySelector('.js-accordion-icon'),
				height: 0,
				active: false
			}

			// Check for our parent, content and icon
			if (accordion.parent && accordion.content && accordion.icon) {
				// Push our accordion elements into the accordions array
				accordions.push(accordion);

				accordion.element.addEventListener('click', () => {
					// Toggle out active class
					accordion.icon.classList.toggle('isActive');

					// Toggle our active state
					accordion.active = !accordion.active;

					// Check if the item is expanded or not
					if (accordion.active) {
						// Expand the accordion

						if (options.limitToOneOpen === true) {
							closeNonActiveAcorrdions(accordion, accordions);
						}
						
						// Set our contnent height based off the object height
						accordion.content.style.height = accordion.height + 'px';

					} else {
						// Close the accordion

						// Set the height to 0 to collapse the content
						setTimeout(() => {
							accordion.content.style.height = '0px'
						}, 0);
					}
				})
			}
		});

		// Set the heights on load within our accordions array
		setAccordionHeights(accordions);

		// Run the helper on resize to allow the accordions to easly open
		window.addEventListener('resize', () => {
			setAccordionHeights(accordions);
		});
	}

	// Helper function to set the heights of the accordions
	function setAccordionHeights(accordions:AccordionItem[]) : void {
		accordions.map((accordion) => {
			// set height of content to auto
			accordion.content.style.height = 'auto';

			// store the height of the accordion
			accordion.height = accordion.content.clientHeight;

			// set the height back to 0 to hide the accordion
			accordion.content.style.height = accordion.active ? accordion.height + 'px' : '0px';
		});
	}


	// Close all but the active accordions
	function closeNonActiveAcorrdions(accordionToExclude:AccordionItem, accordions:AccordionItem[]) : void {
		// Set an array of accrodions to close
		let accordionsToClose:AccordionItem[] = accordions.filter(accordion => accordion !== accordionToExclude);

		accordionsToClose.map((accordion) => {
			// Close the accordion content
			accordion.content.style.height = '0px';

			// Remove Active Class
			accordion.icon.classList.remove('isActive');

			// Set the status to active flase
			accordion.active = false;
		});
	}
}