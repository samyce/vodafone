<?php


namespace app\resolver;

use app\entity\CsvRowEntity;
use app\enum\ActionEnum;
use app\exception\CsvRowException;

/**
 * Class CsvResolver
 * @package app\resolver
 *
 * Logic with csv data
 */
class CsvResolver
{
    const CREDIT_LIMIT_200  = 200;
    const MONTH_LIMIT_5   = 5;
    const CREDIT_LIMIT_300  = 300;
    const MONTH_LIMIT_2   = 2;

    /**
     * Resolve action
     * @param CsvRowEntity $csvRow
     * @return array
     */
    public function resolveAction(CsvRowEntity $csvRow) : array
    {
        if (empty($csvRow)) {
            return [];
        }

        $now = new \DateTime();
        $diff = (int) $csvRow->getDate()->diff($now)->format('%m');

        if (!is_int($diff)) {
            throw  new CsvRowException();
        }

        $data['name'] = $csvRow->getName();

        $actions[ActionEnum::CREDIT] = $csvRow->getCredit() < $this::CREDIT_LIMIT_200;
        $actions[ActionEnum::LAST_TOP_UP_DATE] = $diff > $this::MONTH_LIMIT_5;
        $actions[ActionEnum::CREDIT_LAST_TOP_UP_DATE] =
            $csvRow->getCredit() <= $this::CREDIT_LIMIT_300 && $diff < $this::MONTH_LIMIT_2;

        $data['actions'] = $actions;

        return $data;
    }

    /**
     * @param array $actionData actions for one data row
     * @return int[]
     */
    public function resolveStats(array $actionData)
    {
        $data = [
            ActionEnum::CREDIT                  => 0,
            ActionEnum::LAST_TOP_UP_DATE        => 0,
            ActionEnum::CREDIT_LAST_TOP_UP_DATE => 0,
        ];
        
        foreach ($actionData as $result) {
            if (empty($result['actions'])) {
                continue;
            }
            $this::makeStat($data, $result, ActionEnum::CREDIT);
            $this::makeStat($data, $result, ActionEnum::LAST_TOP_UP_DATE);
            $this::makeStat($data, $result, ActionEnum::CREDIT_LAST_TOP_UP_DATE);
        }
        return $data;
    }

    /**
     * @param array $data result data
     * @param array $actionData actions for one data row
     * @param string $action ActionEnum
     */
    private static function makeStat(array &$data, array $actionData, string $action)
    {
        if (!empty($actionData['actions'][$action])) {
            $data[$action]++;
        }
    }
}
