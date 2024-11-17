/**
 * Finalizes extension.
 *
 * @type {FinalizeCallback}
 * @param {FinalizeArgs} args Args.
 */
export async function finalize( { extendRootData } ) {
	extendRootData( { userAgent: navigator.userAgent } );
}
