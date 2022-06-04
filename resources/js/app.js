require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { ScratchCard, SCRATCH_TYPE } from '../../node_modules/scratchcard-js/build/scratchcard.js'

window.ScratchCard = ScratchCard;
window.SCRATCH_TYPE = SCRATCH_TYPE;

import JSConfetti from 'js-confetti';

window.JSConfetti = JSConfetti;
