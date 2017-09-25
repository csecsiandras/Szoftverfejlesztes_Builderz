using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using System;

public class Block
{
    public Transform blockTransform;
}

public class GameManager : MonoBehaviour
{
    private float blockSize = 1f;

    public Block[,,] blocks = new Block[5, 5, 5];
    public GameObject blockPrefab;

    private GameObject foundationObject;
    private Vector3 blockOffset;
    private Vector3 foundationCenter = new Vector3(2.5f, 0, 2.5f);

    private void Start()
    {
        foundationObject = GameObject.Find("Foundation");
        blockOffset = new Vector3(0.5f * blockSize, 0 * blockSize, 0.5f * blockSize);
    }

    private void Update()
    {
        if(Input.GetMouseButtonDown(0))
        {
            RaycastHit hit;
            if (Physics.Raycast(Camera.main.ScreenPointToRay(Input.mousePosition), out hit, 30.0f)) 
            {
                
                Vector3 index = BlockPosition(hit.point);

                int x = (int)index.x
                    , y = (int)index.y
                    , z = (int)index.z;

                if(blocks[x,y,z] == null)
                {
                    GameObject go = Instantiate(blockPrefab) as GameObject;
                    go.transform.localScale = Vector3.one * blockSize;

                    PostitionBlock(go.transform, index);

                    blocks[x, y, z] = new Block
                    {
                        blockTransform = go.transform
                    };
                }
                else
                {
                    GameObject go = Instantiate(blockPrefab) as GameObject;
                    go.transform.localScale = Vector3.one * blockSize;

                    Vector3 newIndex = BlockPosition(hit.point + hit.normal);
                    PostitionBlock(go.transform, newIndex);

                 // Debug.Log("Error: clicking inside of a cube at position " + index.ToString());
                }
            }
        }
    }

    private Vector3 BlockPosition(Vector3 hit)
    {
        //Transform world point into block array
        Vector3 fnd = foundationObject.transform.position - foundationCenter;
        float x = (int)(hit.x + fnd.x);
        float y = (int)(hit.y + fnd.y);
        float z = (int)(hit.z + fnd.z);

        return new Vector3(x, y, z);
    }

    private void PostitionBlock(Transform t, Vector3 index)
    {
        t.position = (index + blockOffset) + (foundationObject.transform.position - foundationCenter);
    }
}
