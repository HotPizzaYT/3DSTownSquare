/* Polyfill service v3.111.0
 * For detailed credits and licence information see https://github.com/financial-times/polyfill-service.
 * 
 * Features requested: AudioContext
 * 
 * - AudioContext, License: CC0 */

(function(self, undefined) {

// AudioContext
(function () {
	'use strict';

	var
	AudioContext = window.AudioContext = window.AudioContext || window.webkitAudioContext,
	AudioContextPrototype = AudioContext.prototype;

	Object.defineProperties(AudioContextPrototype, {
		createGain: {
			value: AudioContextPrototype.createGain || AudioContextPrototype.createGainNode
		},
		createDelay: {
			value: AudioContextPrototype.createDelay|| AudioContextPrototype.createDelayNode
		},
		createScriptProcessor: {
			value: AudioContextPrototype.createScriptProcessor || AudioContextPrototype.createJavaScriptNode
		}
	});

	var
	audioContext = new AudioContext(),
	oscillatorPrototype = audioContext.createOscillator().constructor.prototype,
	bufferSourcePrototype = audioContext.createBufferSource().constructor.prototype,
	gainGainConstructorPrototype = audioContext.createGain().gain.constructor.prototype;

	Object.defineProperties(oscillatorPrototype, {
		setPeriodicWave: {
			value: oscillatorPrototype.setPeriodicWave || oscillatorPrototype.setWaveTable
		},
		start: {
			value: oscillatorPrototype.start || oscillatorPrototype.noteOn
		},
		stop: {
			value: oscillatorPrototype.stop || oscillatorPrototype.noteOff
		}
	});

	Object.defineProperties(bufferSourcePrototype, {
		start: {
			value: bufferSourcePrototype.start || function start() {
				return arguments.length > 1 ? bufferSourcePrototype.noteGrainOn.apply(this, arguments) : bufferSourcePrototype.noteOn.apply(this, arguments);
			}
		},
		stop: {
			value: bufferSourcePrototype.stop || bufferSourcePrototype.noteOff
		}
	});

	Object.defineProperties(gainGainConstructorPrototype, {
		setTargetAtTime: {
			value: gainGainConstructorPrototype.setTargetAtTime || gainGainConstructorPrototype.setTargetValueAtTime
		}
	});
})();})
('object' === typeof window && window || 'object' === typeof self && self || 'object' === typeof global && global || {});
