<?php

namespace RGU\MetaseoVhs\ViewHelpers;

use TYPO3\CMS\Core\Imaging\ImageManipulation\CropVariantCollection;
use TYPO3\CMS\Core\Resource\Exception\ResourceDoesNotExistException;
use TYPO3Fluid\Fluid\Core\ViewHelper\Exception;

/**
 * Resizes a given image (if required) and the image to metaseo
 *
 * = Examples =
 *
 * <code title="Default">
 * <mvhs:openGraphImage src="EXT:myext/Resources/Public/typo3_logo.png" alt="alt text" />
 * </code>
 *
 * <code title="Image Object">
 * <mvhs:openGraphImage image="{imageObject}" />
 * </code>
 *
 * <code title="Inline notation">
 * {mvhs:openGraphImage(src: 'EXT:viewhelpertest/Resources/Public/typo3_logo.png', alt: 'alt text', minWidth: 30, maxWidth: 40)}
 * </code>
 *
 * <code title="Other resource type (e.g. PDF)">
 * <mvhs:openGraphImage src="fileadmin/user_upload/example.pdf" alt="foo" />
 * </code>
 *
 * <code title="Non-existent image">
 * <mvhs:openGraphImage src="NonExistingImage.png" alt="foo" />
 * </code>
 * <output>
 * Could not get image resource for "NonExistingImage.png".
 * </output>
 */
class OpenGraphImageViewHelper extends AbstractViewHelper
{

    /**
     * @var \TYPO3\CMS\Extbase\Service\ImageService
     */
    protected $imageService;

    /**
     * @param \TYPO3\CMS\Extbase\Service\ImageService $imageService
     */
    public function injectImageService(\TYPO3\CMS\Extbase\Service\ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    /**
     * Initialize arguments.
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerUniversalTagAttributes();
        $this->registerTagAttribute('alt', 'string', 'Specifies an alternate text for an image', false);

        $this->registerArgument('src', 'string', 'a path to a file, a combined FAL identifier or an uid (int). If $treatIdAsReference is set, the integer is considered the uid of the sys_file_reference record. If you already got a FAL object, consider using the $image parameter instead');
        $this->registerArgument('treatIdAsReference', 'bool', 'given src argument is a sys_file_reference record');
        $this->registerArgument('image', 'object', 'a FAL object');
        $this->registerArgument('crop', 'string|bool', 'overrule cropping of image (setting to FALSE disables the cropping set in FileReference)');
        $this->registerArgument('cropVariant', 'string', 'select a cropping variant, in case multiple croppings have been specified or stored in FileReference', false, 'default');

        $this->registerArgument('width', 'string', 'width of the image. This can be a numeric value representing the fixed width of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.');
        $this->registerArgument('height', 'string', 'height of the image. This can be a numeric value representing the fixed height of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.');
        $this->registerArgument('minWidth', 'int', 'minimum width of the image');
        $this->registerArgument('minHeight', 'int', 'minimum width of the image');
        $this->registerArgument('maxWidth', 'int', 'minimum width of the image');
        $this->registerArgument('maxHeight', 'int', 'minimum width of the image');
        $this->registerArgument('absolute', 'bool', 'Force absolute URL', false, false);
    }

    /**
     * Resizes a given image (if required) and renders the respective img tag
     *
     * @see https://docs.typo3.org/typo3cms/TyposcriptReference/ContentObjects/Image/
     *
     * @throws Exception
     * @return string Rendered tag
     */
    public function render()
    {
        if (($this->arguments['src'] === null && $this->arguments['image'] === null) || ($this->arguments['src'] !== null && $this->arguments['image'] !== null)) {
            throw new Exception('You must either specify a string src or a File object.', 1382284106);
        }

        try {
            $image = $this->imageService->getImage($this->arguments['src'], $this->arguments['image'], $this->arguments['treatIdAsReference']);
            $cropString = $this->arguments['crop'];
            if ($cropString === null && $image->hasProperty('crop') && $image->getProperty('crop')) {
                $cropString = $image->getProperty('crop');
            }
            $cropVariantCollection = CropVariantCollection::create((string)$cropString);
            $cropVariant = $this->arguments['cropVariant'] ?: 'default';
            $cropArea = $cropVariantCollection->getCropArea($cropVariant);
            $processingInstructions = [
                'width' => $this->arguments['width'],
                'height' => $this->arguments['height'],
                'minWidth' => $this->arguments['minWidth'],
                'minHeight' => $this->arguments['minHeight'],
                'maxWidth' => $this->arguments['maxWidth'],
                'maxHeight' => $this->arguments['maxHeight'],
                'crop' => $cropArea->isEmpty() ? null : $cropArea->makeAbsoluteBasedOnFile($image),
            ];
            $processedImage = $this->imageService->applyProcessingInstructions($image, $processingInstructions);
            $imageUri = $this->imageService->getImageUri($processedImage, $this->arguments['absolute']);

            $alt = $image->getProperty('alternative') ?: $image->getProperty('title');

            if (!empty($this->arguments['alt'])) {
                $alt = $this->arguments['alt'];
            }

            // There is a Issue in the Extantion Metaseo
            // We check here, if there is a Image, then Use setOpenGraphTag otherwise use setCustomOpenGraphTag
            // We use the Hook "metatagOutput" to correct the MetaData. At the moment, we have to Image Values per dot. The Hook will replace that
            if (empty($GLOBALS['TSFE']->page['tx_metaseo_opengraph_image'])) {
                $this->metaseoConnector->setCustomOpenGraphTag('image:url', $imageUri);

                if (!empty($alt)) {
                    $this->metaseoConnector->setCustomOpenGraphTag('image:alt', $alt);
                }
            } else {
                $this->metaseoConnector->setOpenGraphTag('image.url', $imageUri);

                if (!empty($alt)) {
                    $this->metaseoConnector->setOpenGraphTag('image.alt', $alt);
                }
            }

            $this->metaseoConnector->setOpenGraphTag('image.width', $processedImage->getProperty('width'));
            $this->metaseoConnector->setOpenGraphTag('image.height', $processedImage->getProperty('height'));
            $this->metaseoConnector->setOpenGraphTag('image.type', $processedImage->getMimeType());
        } catch (ResourceDoesNotExistException $e) {
            // thrown if file does not exist
            throw new Exception($e->getMessage(), 1509741911, $e);
        } catch (\UnexpectedValueException $e) {
            // thrown if a file has been replaced with a folder
            throw new Exception($e->getMessage(), 1509741912, $e);
        } catch (\RuntimeException $e) {
            // RuntimeException thrown if a file is outside of a storage
            throw new Exception($e->getMessage(), 1509741913, $e);
        } catch (\InvalidArgumentException $e) {
            // thrown if file storage does not exist
            throw new Exception($e->getMessage(), 1509741914, $e);
        }
    }
}
