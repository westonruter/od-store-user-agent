/**
 * @typedef {import("../optimization-detective/types.ts").InitializeArgs} InitializeArgs
 * @typedef {import("../optimization-detective/types.ts").InitializeCallback} InitializeCallback
 */

/**
 * Initializes extension.
 *
 * @type {InitializeCallback}
 * @param {InitializeArgs} args Args.
 */
export async function finalize( { extendRootData } ) {
	extendRootData( { userAgent: navigator.userAgent } );
}
