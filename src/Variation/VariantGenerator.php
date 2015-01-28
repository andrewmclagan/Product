<?php namespace Jiro\Product\Variation;

use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Variation\Model\VariableInterface;
use Sylius\Component\Variation\Model\VariantInterface;

/**
 * Abstract variant generator service implementation.
 *
 * It is used to create all possible combinations of product options
 * and create Variant models from them.
 *
 * Example:
 *
 * If object has two options with 3 possible values each,
 * this service will create 9 Variant's and assign them to the
 * object. It ignores existing and invalid variants.
 *
 * @author Andrew McLagan <andrewmclagan@gmail.com>
 */

class VariantGenerator implements VariantGeneratorInterface
{
    /**
     * Variant manager.
     *
     * @var RepositoryInterface
     */
    protected $variantRepository;

    /**
     * Constructor.
     *
     * @param RepositoryInterface $variantRepository
     */
    public function __construct(RepositoryInterface $variantRepository)
    {
        $this->variantRepository = $variantRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function generate(ProductInterface $product)
    {
        if (!$product->hasOptions()) {
            throw new \InvalidArgumentException('Cannot generate variants for an object without options.');
        }

        $optionSet = array();
        $optionMap = array();

        foreach ($product->getOptions() as $k => $option) {
            foreach ($option->getValues() as $value) {
                $optionSet[$k][] = $value->getId();
                $optionMap[$value->getId()] = $value;
            }
        }

        $permutations = $this->getPermutations($optionSet);

        foreach ($permutations as $permutation) {
            $variant = $this->variantRepository->createNew();
            $variant->setObject($product);
            $variant->setDefaults($product->getMasterVariant());

            if (is_array($permutation)) {
                foreach ($permutation as $id) {
                    $variant->addOption($optionMap[$id]);
                }
            } else {
                $variant->addOption($optionMap[$permutation]);
            }

            $product->addVariant($variant);

            $this->process($product, $variant);
        }
    }

    /**
     * Override if needed.
     *
     * @param ProductInterface $product
     * @param VariantInterface  $variant
     */
    protected function process(ProductInterface $product, VariantInterface $variant)
    {
    }

    /**
     * Get all permutations of option set.
     * Cartesian product.
     *
     * @param array   $array
     * @param Boolean $recursing
     *
     * @return array
     *
     * @throws \InvalidArgumentException
     */
    protected function getPermutations($array, $recursing = false)
    {
        $countArrays = count($array);

        if (1 === $countArrays) {
            return reset($array);
        } elseif (0 === $countArrays) {
            throw new \InvalidArgumentException('At least one array is required.');
        }

        $keys = array_keys($array);

        $a = array_shift($array);
        $k = array_shift($keys);

        $b = $this->getPermutations($array, true);

        $result = array();

        foreach ($a as $valueA) {
            if ($valueA) {
                foreach ($b as $valueB) {
                    if ($recursing) {
                        $result[] = array_merge(array($valueA), (array) $valueB);
                    } else {
                        $result[] = array($k => $valueA) + array_combine($keys, (array) $valueB);
                    }
                }
            }
        }

        return $result;
    }
}
